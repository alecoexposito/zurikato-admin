<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 15/08/18
 * Time: 16:27
 */

namespace App\Controller;


use App\Entity\Vehicle;
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