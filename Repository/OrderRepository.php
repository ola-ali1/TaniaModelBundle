<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ibtikar\TaniaModelBundle\Entity\Order;

class OrderRepository extends EntityRepository
{

    /**
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @param integer $shiftId
     * @return array
     * @throws \Exception
     */
    public function getShiftsOrdersCountToday($shiftId = null)
    {
        $queryBuilder = $this->createQueryBuilder('o')
                ->select('COUNT(o.id) as ordersCount, IDENTITY(o.shift) as shiftId')
                ->where('o.requiredDeliveryDate IS NOT NULL')
                ->andWhere('o.requiredDeliveryDate >= :start')
                ->andWhere('o.requiredDeliveryDate <= :end')
                ->setParameter('start', new \DateTime('midnight'))
                ->setParameter('end', new \DateTime('tomorrow'))
                ;
        if ($shiftId) {
            $queryBuilder->andWhere('o.shift = :shiftId')->setParameter('shiftId', $shiftId);
        }
        return $queryBuilder->groupBy('o.shift')->getQuery()->getResult();
    }

    public function getDriverRate($driverId)
    {
        $query = $this->createQueryBuilder('o')
                ->select('AVG(o.rate) AS rate_average')
                ->andWhere("o.driver = :driver")
                ->andWhere("o.rate IS NOT NULL")
                ->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
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
        $query = $query->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order");
                if($page !== 0){
                    $query = $query->setMaxResults($limit)
                                ->setFirstResult(($page -1)* $limit);
                }
                $query = $query->setParameters(array('user'=> $userId, 'statuses' => Order::$statusCategories[$category]))
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
        if($page !== 0){
            $query = $query->setMaxResults($limit)
                        ->setFirstResult(($page -1)* $limit);
        }
        $query = $query->setParameters(array('driver'=> $driverId, 'statuses' => Order::$statusCategories[$category]))
                ->orderBy('o.id', 'DESC')
                ->getQuery()
                ->getResult();

        return $query;
    }

    public function getDriverListOrdersV2($driverId, $category, $page){

        $limit = 10;
        $queryOrder = $this->createQueryBuilder('o')
            ->select('o')
            ->andWhere('o.isAutoassigned = 1')
            ->andWhere("o.status = :statusNew")
            ->setParameter('statusNew', 'new')
            ->setMaxResults($limit)->setFirstResult(($page -1)* $limit)
            ->orderBy('o.id', 'DESC')
            ->getQuery()
            ->getResult();
        $returnArray = array();
        foreach ($queryOrder as $order) {
            $orderId = $order->getId();
            $query = $this->createQueryBuilder('o')
                ->select('distinct e')
                ->from('IbtikarTaniaModelBundle:Driver', 'e');
            $query->join('e.vanDrivers', 'v', 'WITH', 'v.van IS NOT NULL');
            $query->join('v.van', 'van');
            $query->andWhere('e.id = '.$driverId);

            if ($order) {
                if (!$order->isOrderAssignableToOfflineDrivers()) {
                    $query->andWhere('e.status = 1');
                }
                if ($order->getCityArea()) {
                    $query->join('e.driverCityAreas', 'a', 'WITH', 'a.cityArea = ' . $order->getCityArea()->getId());
                }
            }
            $receivingDate = (new \DateTime('@' . $order->getReceivingDate()))->format('Y-m-d');

            $shiftFrom = $order->getShiftFrom()->format('H:i:s');
            $shiftTo = $order->getShiftTo()->format('H:i:s');

            $query->leftJoin('e.driverOrders', 'o1', 'WITH', "DATE_FORMAT(FROM_UNIXTIME(o1.receivingDate), '%Y-%m-%d') = :receivingDate AND (DATE_FORMAT(o1.shiftFrom, '%H:%m') BETWEEN :shiftFrom AND :shiftTo OR DATE_FORMAT(o1.shiftTo, '%H:%m') BETWEEN :shiftFrom AND :shiftTo) AND o1 INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order AND o1.status in (:activeStatuses)")
                ->setParameter('shiftFrom', $shiftFrom)
                ->setParameter('shiftTo', $shiftTo);

             $activeStatuses = array(Order::$statuses['verified'], Order::$statuses['delivering']);
               $query->setParameter('receivingDate', $receivingDate)->setParameter('activeStatuses', $activeStatuses);
            $querys = $query->getQuery()->getResult();
            if(count($querys) > 0){
                $returnArray[] = $order;
            }
            unset($querys);
        }
        return $returnArray;
    }

    public function getYearlyOrdersCount($year = NULL)
    {
        $start = date('Y-01-01 00:00:00');
        $end = date('Y-12-31 23:59:59');

        return $this->createQueryBuilder('o')
		->select('COUNT(o.id)')
                ->andWhere('o.createdAt >= :start')
                ->andWhere('o.createdAt <= :end')
                ->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
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
                ->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
                ->setParameter('start', $start)
                ->setParameter('end', $end)
                ->setParameter('delivered', Order::$statuses['delivered'])
                ->getQuery()
                ->getSingleScalarResult();
    }

    /**
     * Get orders created at rang from and to date
     * mainly created for the tania's integration
     *
     * @param datetime $fromDate
     * @param datetime $toDate
     * @return Orders list
     */
    public function getOrdersCreatedAt($fromDate, $toDate)
    {
        $query = $this->createQueryBuilder('o');
        $from = new \DateTime($fromDate->format("Y-m-d")." 00:00:00");
        $to   = new \DateTime($toDate->format("Y-m-d")." 23:59:59");

        $query = $query->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
                    ->andWhere('o.createdAt BETWEEN :from AND :to')
                    ->setParameter('from', $from )
                    ->setParameter('to', $to)
                ->orderBy('o.id', 'DESC')
                ->getQuery()
                 ->getResult();

        return $query;
    }

    public function getOrdersCreatedAtV2($fromDate, $toDate)
    {
        $start = new \DateTime($fromDate->format("Y-m-d")." 00:00:00");
        $end   = new \DateTime($toDate->format("Y-m-d")." 23:59:59");

        return $this->createQueryBuilder('o')
            ->addOrderBy('o.createdAt', 'ASC')
            ->andWhere('o.createdAt > :now')
            ->andWhere('o.createdAt <= :end')
            ->setParameter('now', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }
    public function getOrdersCreatedAtOld($fromDate, $toDate){
        $query = $this->createQueryBuilder('o');

        $query = $query->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
                ->andWhere('o.createdAt >= :start')
                ->andWhere('o.createdAt <= :end')
                ->setParameters(['start' => $fromDate->format('Y-m-d H:i:s'),'end' => $toDate->format('Y-m-d H:i:s')])
                ->orderBy('o.id', 'DESC')
                ->getQuery()
                 ->getResult();

        return $query;
    }

    public function getOrdersStatistics()
    {
        return $this->createQueryBuilder('o')
                    ->select('COUNT(o) AS ordersCount, AVG(o.rate) as avgRate')
                    ->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
                    ->getQuery()
                    ->getScalarResult();
    }

    public function getOrdersStatusCount($status)
    {
        return $this->createQueryBuilder('o')
		->select('COUNT(o.id) as ordersCount, o.status')
                ->andWhere("o INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Order")
                ->andWhere('o.status in (:status)')
                ->setParameter('status', $status)
                ->groupBy('o.status')
                ->getQuery()
                ->getScalarResult();
    }

    /**
     * Count of promo-code used time by sepeific user
     *
     * @param int $userId
     * @param int $promoCodeId
     * @return int count
     */
    public function countPromoCodeUsedTimesByUser($userId, $promoCodeId)
    {
        return $this->createQueryBuilder('o')
                ->select('count(1)')
                ->where('o.promoCode = :promoCodeId')->setParameter('promoCodeId', $promoCodeId)
                ->andWhere('o.user = :user')->setParameter('user', $userId)
                ->getQuery()->getSingleScalarResult();
    }
    
    public function getShiftsOrdersCountForShift($shiftId = null,$actualDate)
    {
        $beginOfDay = clone $actualDate;

        $beginOfDay->modify('midnight');

        $endOfDay = clone $beginOfDay;
        $endOfDay->modify('tomorrow');

        $queryBuilder = $this->createQueryBuilder('o')
        ->select('COUNT(o.id) as ordersCount, IDENTITY(o.shift) as shiftId')
        ->where('o.requiredDeliveryDate IS NOT NULL')
        ->andWhere('o.requiredDeliveryDate >= :start')
        ->andWhere('o.requiredDeliveryDate < :end')
        ->setParameter('start', $beginOfDay ->format('Y-m-d'))
        ->setParameter('end',$endOfDay ->format('Y-m-d'))
        ;
        if ($shiftId) {
            $queryBuilder->andWhere('o.shift = :shiftId')->setParameter('shiftId', $shiftId);
        }
        return $queryBuilder->groupBy('o.shift')->getQuery()->getResult();
    }

}
