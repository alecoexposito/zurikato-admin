<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 4/04/18
 * Time: 14:49
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class TagsRepository extends EntityRepository
{
//    public function __construct(RegistryInterface $registry)
//    {
//        parent::__construct($registry, Device::class);
//    }

    public static function available(EntityRepository $repository)
    {
        return $repository->createQueryBuilder('t')
            ->leftJoin('t.tire', 'tire')
            ->where("tire is null");
    }
}