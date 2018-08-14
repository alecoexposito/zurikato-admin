<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 4/04/18
 * Time: 14:49
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class DeviceRepository extends EntityRepository
{
//    public function __construct(RegistryInterface $registry)
//    {
//        parent::__construct($registry, Vehicle::class);
//    }

    public static function available(EntityRepository $repository)
    {
        return $repository->createQueryBuilder("d")
            ->leftJoin('d.vehicle', 'v')
            ->where('v is null');
    }
}