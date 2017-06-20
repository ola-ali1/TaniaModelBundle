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
                ->andWhere('d INSTANCE OF Ibtikar\TaniaModelBundle\Entity\Driver')
                ->setParameter('username', $username)
                ->getQuery()
                ->getOneOrNullResult();
    }
}