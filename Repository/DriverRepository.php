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
                ->select('d.driverRate, d.id, d.fullName, d.fullNameAr, COUNT(o.id) as ordersCount')
                ->leftJoin('d.driverOrders', 'o', 'WITH', 'o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order AND o.rate IS NOT NULL')
                ->where('d.driverRate in (:topRates)')
                ->setParameter('topRates', $topRates)
                ->orderBy('d.driverRate','DESC')
                ->groupBy('d.id')
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
        $today = strtotime('today midnight');
        $tomorrow = strtotime('tomorrow midnight');
        $statuses = array(Order::$statuses['verified'], Order::$statuses['delivering'], Order::$statuses['delivered']);

        return $this->createQueryBuilder('d')
		->select('v.vanNumber, d.id, d.longitude, d.latitude, d.fullName, d.fullNameAr, count(o.id) as ordersCount, currentOrder.longitude as orderLongitude, currentOrder.latitude as orderLatitude')
                ->leftJoin('d.driverOrders', 'o', 'WITH', 'o.receivingDate >= :today and o.receivingDate < :tomorrow AND o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order AND o.status in (:statuses)')
                ->leftJoin('d.vanDrivers', 'vd')
                ->leftJoin('vd.van', 'v')
                ->leftJoin('d.driverOrders', 'currentOrder', 'WITH', 'currentOrder.status = :delivering AND currentOrder INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order')
                ->setParameters(['today' => $today, 'tomorrow' => $tomorrow, 'statuses' => $statuses])
                ->setParameter('delivering', Order::$statuses['delivering'])
                ->where('d.status = '.TRUE)
                ->andWhere('d.longitude != 0')
                ->andWhere('d.latitude != 0')
                ->groupBy('d.id, vd.id, currentOrder.id')
                ->getQuery()
                ->getResult();
    }
}
