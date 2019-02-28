<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrderStatusHistoryRepository extends EntityRepository
{
    public function getOrdersStatusCount($fromDate)
    {
        return $this->createQueryBuilder('ost')
                ->join('ost.order', 'o', 'WITH', 'ost.status = o.status')
		->select('COUNT(ost.id) as ordersCount,ost.status')
                ->andWhere('ost.createdAt >= :start')
                ->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
                ->setParameter('start', $fromDate)
                ->groupBy('ost.status')
                ->getQuery()
                ->getResult();
    }
}