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

    public function getListOrders($userId, $category, $page){
        $limit = 10;
        $query = $this->createQueryBuilder('o')
                ->select('o')
                ->andWhere("o.user = :user")
                ->andWhere("o.category = :category")
                ->setMaxResults($limit)
                ->setFirstResult(($page -1)* $limit)
                ->setParameters(array('user'=> $userId, 'category' => $category))
                ->getQuery()
                ->getResult();

        return $query;
    }
}