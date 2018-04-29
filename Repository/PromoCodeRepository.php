<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ibtikar\TaniaModelBundle\Entity\PromoCode;

class PromoCodeRepository extends EntityRepository
{

    /**
     * Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     *
     * @return PromoCode[]
     */
    public function getPromoCodeThatNeedsSend()
    {
        return $this->createQueryBuilder('pc')
                ->select('pc')
                ->where('pc.enabled = 1')
                ->andWhere('pc.sendToAllUsers = 1')
                ->setMaxResults(1)
                ->getQuery()->getResult();
    }

    /**
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @param integer $id
     * @param double $orderDiscountAmount
     * @param boolean $usedByUserBefore
     * @return boolean
     */
    public function increasePromoCodeUsage($id, $orderDiscountAmount, $usedByUserBefore = false)
    {
        $dql = '
            UPDATE IbtikarTaniaModelBundle:PromoCode pc
            SET pc.numberOfUsedTimes = pc.numberOfUsedTimes + 1
            SET pc.usageTotalAmount = pc.usageTotalAmount + :usageTotalAmount
            ';
        if (!$usedByUserBefore) {
            $dql .= ' SET pc.numberOfUsedByUsers = pc.numberOfUsedByUsers + 1';
        }
        $dql .= ' WHERE pc.id = :id';
        return $this->getEntityManager()->createQuery($dql)
                ->setParameter('id', $id)
                ->setParameter('usageTotalAmount', $orderDiscountAmount)
                ->execute();
    }

    /**
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @param integer $id
     * @param double $orderDiscountAmount
     * @param boolean $usedByUserBefore
     * @return boolean
     */
    public function decreasePromoCodeUsage($id, $orderDiscountAmount, $usedByUserBefore = false)
    {
        $dql = '
            UPDATE IbtikarTaniaModelBundle:PromoCode pc
            SET pc.numberOfUsedTimes = pc.numberOfUsedTimes - 1
            SET pc.usageTotalAmount = pc.usageTotalAmount - :usageTotalAmount
            ';
        if (!$usedByUserBefore) {
            $dql .= ' SET pc.numberOfUsedByUsers = pc.numberOfUsedByUsers - 1';
        }
        $dql .= ' WHERE pc.id = :id';
        return $this->getEntityManager()->createQuery($dql)
                ->setParameter('id', $id)
                ->setParameter('usageTotalAmount', $orderDiscountAmount)
                ->execute();
    }
}
