<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 15/08/18
 * Time: 16:27
 */

namespace App\Controller;


use App\Entity\Vehicle;
use App\Entity\VehicleCheck;
use App\Repository\VehicleCheckRepository;
use App\Repository\VehicleRepository;
use App\Service\AntenasManager;
use Doctrine\Common\Collections\Collection;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api")
 */
class ApiController extends FOSRestController
{
    private $antenasManager;
    /**
     * ApiController constructor.
     */
    public function __construct(AntenasManager $antenasManager)
    {
        $this->antenasManager = $antenasManager;
    }


    /**
     * @Rest\Post("/receive-tags", name="receive_tags")
     */
    public function receiveTags(Request $request)
    {
        /**
         * @var VehicleRepository $vehicleRepository
         * @var VehicleCheck $existentVehicleCheck
         * @var VehicleCheckRepository $vehicleCheckRepository
         */
        // getting the tags rfids from body content
        $body = $request->getContent();
        $tagsArray = json_decode($body);

        // getting the vehicles to where the tags belong
        $vehicleRepository = $this->getDoctrine()->getRepository(Vehicle::class);
        $vehicles = $vehicleRepository->vehiclesWithTags($tagsArray);
        $vehicleCheckRepository = $this->getDoctrine()->getRepository(VehicleCheck::class);

        // for each vehicle will check if it is being processed or in pause, it either updates or creates if it doesn't exists
        foreach ($vehicles as $index => $vehicle) {
//            $this->getDoctrine()->getManager()->getConnection()->commit();
            $existentVehicleCheck = $vehicleCheckRepository->findOneBy(array(
                'vehicle' => $vehicle,
                'status' => array(VehicleCheck::STATUS_CURRENT, VehicleCheck::STATUS_PAUSED)
            ));
            if(is_object($existentVehicleCheck)) {
                $hasUpdated = $existentVehicleCheck->addArrivedTags($tagsArray);
                if($hasUpdated) {
                    $existentVehicleCheck->setUpdatedat(new \DateTime());
                    $this->getDoctrine()->getManager()->merge($existentVehicleCheck);
                    $this->antenasManager->sendVehicleCheckToSocket($existentVehicleCheck);
                }
            } else {
                $vehicleCheck = new VehicleCheck();
                $vehicleCheck->setVehicle($vehicle);
                $vehicleCheck->setStatus(VehicleCheck::STATUS_PAUSED);
                $vehicleCheck->addArrivedTags($tagsArray);
                $this->getDoctrine()->getManager()->persist($vehicleCheck);
            }
            $this->getDoctrine()->getManager()->flush();
        }
        // if there isn't any current set to current next in pause
        if($vehicleCheckRepository->countCurrentVehicleChecks() == 0) {
            $vehicleCheckPaused = $vehicleCheckRepository->findBy(array(
                'status' => VehicleCheck::STATUS_PAUSED
            ), array('id' => 'asc'), 1);
            if(count($vehicleCheckPaused) > 0) {
                $vehicleCheckPaused[0]->setStatus(VehicleCheck::STATUS_CURRENT);
                $this->getDoctrine()->getManager()->merge($vehicleCheckPaused[0]);
                $this->getDoctrine()->getManager()->flush();
                $this->antenasManager->sendVehicleCheckToSocket($vehicleCheckPaused[0]);
                $this->getDoctrine()->getManager()->flush();
            }
        }


        $serializer = $this->get('jms_serializer');
        $body = $request->getContent();
        $results = json_decode($body);
        return new Response($serializer->serialize($body, "json"));
    }

    /**
     * @Rest\Get("/test", name="test")
     */
    public function getTest()
    {
        $serializer = $this->get('jms_serializer');
        $repository = $this->getDoctrine()->getRepository(Vehicle::class);
        $results = $repository->findAll();
//        echo count($results);
//        return View::create($results, Response::HTTP_OK, [])->getResponse();
        return new Response($serializer->serialize($results, "json"));
    }

    /**
     * @Rest\Post("/test-post", name="testpost")
     */
    public function testPost(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $body = $request->getContent();
        $results = json_decode($body);
//        echo count($results);
//        return View::create($results, Response::HTTP_OK, [])->getResponse();
        return new Response($serializer->serialize("{success: true}", "json"));
    }

    /**
     * @Rest\Post("/resend", name="resend")
     */
    public function resend(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $body = $request->getContent();

        $curl = curl_init("http://localhost:3007/api/v1/resend/");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_POST,           1 );
        curl_setopt($curl, CURLOPT_POSTFIELDS,     $body );
//        curl_setopt($curl, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($body))
        );

        $result = curl_exec($curl);
//        $results = json_decode($body);
        return new Response($body);
    }
}