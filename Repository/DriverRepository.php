<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

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
}
