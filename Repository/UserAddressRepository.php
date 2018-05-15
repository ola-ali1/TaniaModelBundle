<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use \Doctrine\ORM\EntityRepository;
use Ibtikar\TaniaModelBundle\Entity\UserAddress;

class UserAddressRepository extends EntityRepository
{

    public function getAllMasajed($page, $userLat, $userLong, $limit = 25){

        $query = $this->createQueryBuilder('l')
            ->select('l')
            ->where("l.type = :masjedType")
            ->addSelect('((ACOS(SIN(:lat * PI() / 180) * SIN(l.latitude * PI() / 180) + COS(:lat * PI() / 180) * COS(l.latitude * PI() / 180) * COS((:lng - l.longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) as HIDDEN distance')
            ->orderBy('distance');

        if($page !== 0){
            $query = $query->setMaxResults($limit)
                ->setFirstResult(($page -1)* $limit);
        }
        $query = $query->setParameters(array('masjedType'=> UserAddress::TYPE_MASAJED, 'lat' => $userLat, 'lng' => $userLong))
            ->orderBy('l.id', 'DESC')
            ->getQuery()
            ->getResult();

        return $query;
    }

}