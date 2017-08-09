<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;
use Ibtikar\TaniaModelBundle\Entity\Order;

class DriverRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('d')
                ->where('d.username = :username')
                ->orWhere('d.phone = :username')
                ->setParameter('username', $username)
                ->getQuery()
                ->getOneOrNullResult();
    }

    public function getTopDrivers($topRates)
    {
        return $this->createQueryBuilder('d')
		->select('d.id, d.driverRate, d.fullName, d.fullNameAr')
                ->where('d.driverRate in (:topRates)')
                ->setParameter('topRates', $topRates)
                ->orderBy('d.driverRate','DESC')
                ->getQuery()
                ->getResult();
    }

    public function getDriversCount()
    {
        return $this->createQueryBuilder('d')
		->select('COUNT(d.id)')
                ->getQuery()
                ->getSingleScalarResult();
    }

    public function getMapDrivers()
    {
        $today = date('Y-m-d H:i:s', strtotime('today midnight'));
        return $this->createQueryBuilder('d')
		->select('d.id, d.longitude, d.latitude, d.fullName, d.fullNameAr, count(o.id) as ordersCount, currentOrder.longitude as orderLongitude, currentOrder.latitude as orderLatitude')
                ->leftJoin('d.driverOrders', 'o', 'WITH', 'o.createdAt >= :today')
                ->leftJoin('d.driverOrders', 'currentOrder', 'WITH', 'currentOrder.status = :delivering')
                ->setParameter('today', $today)
                ->setParameter('delivering', Order::$statuses['delivering'])
                ->where('d.status = '.TRUE)
                ->groupBy('d.id')
                ->getQuery()
                ->getResult();
    }
}
