<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 4/04/18
 * Time: 14:49
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class VehicleRepository extends EntityRepository
{
//    public function __construct(RegistryInterface $registry)
//    {
//        parent::__construct($registry, Vehicle::class);
//    }

//    public static function available(EntityRepository $repository)
//    {
//        return $repository->createQueryBuilder("v")
//            ->select("v.device")
////            ->from("App\Entity\Vehicle", "v")
//            ->join('v.device', 'd');
//    }

    public function vehiclesWithTags($ids)
    {
        $qb = $this->createQueryBuilder('v')
            ->join('v.tires', 't')
            ->join('t.controlTag', 'tag')
            ->where('tag.rfid in (:ids)')
            ->setParameter("ids", $ids);
        return $qb->getQuery()->getResult();
    }
}