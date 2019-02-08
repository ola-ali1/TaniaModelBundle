<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class VanRepository extends EntityRepository
{


    public function getVansCount()
    {
        return $this->createQueryBuilder('v')
		->select('COUNT(v.id)')
                ->getQuery()
                ->getSingleScalarResult();
    }
}
