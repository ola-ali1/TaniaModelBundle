<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ibtikar\TaniaModelBundle\Entity\Order;

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
                ->andWhere("o.user = :user");
        if($category == 'current'){
            $query = $query->andWhere(
                            $query->expr()->orX("o.status in (:statuses)","o.status = 'returned'")
                    );
        }
        else{
            $query = $query->andWhere('o.status in (:statuses)');
        }
        $query = $query->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
                ->setMaxResults($limit)
                ->setFirstResult(($page -1)* $limit)
                ->setParameters(array('user'=> $userId, 'statuses' => Order::$statusCategories[$category]))
                ->orderBy('o.id', 'DESC')
                ->getQuery()
                ->getResult();

        return $query;
    }

    public function getDriverListOrders($driverId, $category, $page){
        $limit = 10;
        $query = $this->createQueryBuilder('o')
                ->select('o')
                ->andWhere("o.driver = :driver");
        if($category == 'past'){
            $query = $query->andWhere(
                            $query->expr()->orX("o.status in (:statuses)","o.status = 'returned'")
                    );
        }
        else{
            $query = $query->andWhere('o.status in (:statuses)');
        }
        $query = $query->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
                ->setMaxResults($limit)
                ->setFirstResult(($page -1)* $limit)
                ->setParameters(array('driver'=> $driverId, 'statuses' => Order::$statusCategories[$category]))
                ->orderBy('o.id', 'DESC')
                ->getQuery()
                ->getResult();

        return $query;
    }

    public function getYearlyOrdersCount($year = NULL)
    {
        $start = date('Y-01-01 00:00:00');
        $end = date('Y-12-31 23:59:59');

        return $this->createQueryBuilder('o')
		->select('COUNT(o.id)')
                ->andWhere('o.createdAt >= :start')
                ->andWhere('o.createdAt <= :end')
                ->setParameter('start', $start)
                ->setParameter('end', $end)
                ->getQuery()
                ->getSingleScalarResult();
    }

    public function getYearlyTotalRevenue($year = NULL)
    {
        $start = date('Y-01-01 00:00:00');
        $end = date('Y-12-31 23:59:59');

        return $this->createQueryBuilder('o')
		->select('SUM(o.amountDue)')
                ->andWhere('o.createdAt >= :start')
                ->andWhere('o.createdAt <= :end')
                ->andWhere('o.status = :delivered')
                ->setParameter('start', $start)
                ->setParameter('end', $end)
                ->setParameter('delivered', Order::$statuses['delivered'])
                ->getQuery()
                ->getSingleScalarResult();
    }
}