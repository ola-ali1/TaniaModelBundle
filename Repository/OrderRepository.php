<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    public function getDriverRate($driverId)
    {
        $query = $this->createQueryBuilder('o')
                ->select('AVG(o.rate) AS rate_average')
                ->andWhere("o.driver = :driver")
                ->andWhere("o.rate IS NOT NULL")
                ->setParameter('driver', $driverId)
                ->getQuery()
                ->getSingleScalarResult();

        return $query;
    }
}