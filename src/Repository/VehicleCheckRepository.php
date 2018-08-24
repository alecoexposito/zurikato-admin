<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 4/04/18
 * Time: 14:49
 */

namespace App\Repository;


use App\Entity\VehicleCheck;
use Doctrine\ORM\EntityRepository;

class VehicleCheckRepository extends EntityRepository
{
    public function countCurrentVehicleChecks()
    {
        $qb = $this->createQueryBuilder('vc')
            ->select('count(1)')
            ->where('vc.status = :statusCurrent')
            ->setParameter('statusCurrent', VehicleCheck::STATUS_CURRENT);
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function changeVehicleCheckStatusCommand()
    {
        $query = "update vehicle_check set status = 'PAUSED' where status = 'CURRENT' and updatedAt < date_add(updatedAt, INTERVAL 30 SECOND)";
        $affectedRows = $this->getEntityManager()->getConnection()->exec($query);
        return $affectedRows;
    }

}