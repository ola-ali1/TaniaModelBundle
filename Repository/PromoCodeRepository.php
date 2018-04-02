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
                ->where('pc.active = 1')
                ->andWhere('pc.sendToAllUsers = 1')
                ->setMaxResults(1)
                ->getQuery()->getResult();
    }
}
