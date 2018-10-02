<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 22/08/18
 * Time: 14:41
 */

namespace App\Service;


use App\Entity\VehicleCheck;
use App\Repository\VehicleCheckRepository;
use Doctrine\ORM\EntityManagerInterface;

class AntenasManager
{
    private $entityManager;

    /**
     * AntenasManager constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Sends data to nodejs webservice that sends data to socket
     * @param $data
     */
    public function sendDataToSocket($data)
    {
        $curl = curl_init("http://187.162.125.161:3007/api/v1/resend/");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_POST,           1 );
        curl_setopt($curl, CURLOPT_POSTFIELDS,     $data );
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        $result = curl_exec($curl);
    }

    public function sendVehicleCheckToSocket(VehicleCheck $vehicleCheck)
    {
        $data = array(
            "vehicleCheckId" => $vehicleCheck->getId(),
            "rfids" => json_decode($vehicleCheck->getArrivedTags()),
            "status" => $vehicleCheck->getStatus()
        );
        $this->sendDataToSocket(json_encode($data));
    }

    public function changeVehicleCheckStatusCommand()
    {
        $result = array(
            'set_to_finished' => 0,
            'set_to_current' => 0
        );
        $currentCountRS = $this->entityManager->getConnection()->query("select count(1) as currents_count from vehicle_check where status = 'CURRENT'");
        $currentsCount = $currentCountRS->fetch()['currents_count'];
        if($currentsCount > 0){
            $finishQuery = "update vehicle_check set status = 'FINISHED' where status = 'CURRENT' and NOW() > date_add(updatedAt, INTERVAL 50 SECOND)";
            $affectedFinishedRows = $this->entityManager->getConnection()->exec($finishQuery);
            $result['set_to_finished'] = $affectedFinishedRows;
            if($affectedFinishedRows > 0 && $currentsCount == 1) {
                $setCurrentQuery = "update vehicle_check set status = 'CURRENT' where status = 'PAUSED' order by id asc limit 1";
                $affectedCurrentRows = $this->entityManager->getConnection()->exec($setCurrentQuery);
                $result['set_to_current'] = $affectedCurrentRows;
            }
        } else {
            $setCurrentQuery = "update vehicle_check set status = 'CURRENT' where status = 'PAUSED' order by id asc limit 1";
            $affectedCurrentRows = $this->entityManager->getConnection()->exec($setCurrentQuery);
            $result['set_to_current'] = $affectedCurrentRows;
        }
        return $result;
    }

    public function getCurrentVehicleCheck()
    {
        $repository = $this->entityManager->getRepository('App\Entity\VehicleCheck');
        return $repository->findOneBy(array(
            'status' => VehicleCheck::STATUS_CURRENT
        ));
    }
}