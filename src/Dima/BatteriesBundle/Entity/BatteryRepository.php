<?php

namespace Dima\BatteriesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BatteryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BatteryRepository extends EntityRepository
{
    public function countAllGroupedByType()
    {
        return $qb = $this->createQueryBuilder('b')
            ->select('b.type, count(b.id) AS num')
            ->groupBy('b.type')
            ->getQuery()
            ->getResult();
    }

    public function deleteAll()
    {
        return $qb = $this->createQueryBuilder('b')
            ->delete()
            ->getQuery()
            ->getResult();
    }
}
