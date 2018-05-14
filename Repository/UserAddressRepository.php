<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use \Doctrine\ORM\EntityRepository;
use Ibtikar\TaniaModelBundle\Entity\UserAddress;

class UserAddressRepository extends EntityRepository
{

    public function getAllMasajed($page, $limit = 25){

        $query = $this->createQueryBuilder('ua')
            ->select('ua')
            ->where("ua.type = :masjedType");

        if($page !== 0){
            $query = $query->setMaxResults($limit)
                ->setFirstResult(($page -1)* $limit);
        }
        $query = $query->setParameters(array('masjedType'=> UserAddress::TYPE_MASAJED))
            ->orderBy('ua.id', 'DESC')
            ->getQuery()
            ->getResult();

        return $query;
    }

}