<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use \Doctrine\ORM\EntityRepository;

class ItemRepository extends EntityRepository
{
    function getItemsNotAssignedToVan($vanId)
    {
        return $this->createQueryBuilder('i')
            ->select('i')
            ->leftJoin('i.vanItems', 'vanItems','WITH','vanItems.van = :vanId')
            ->setParameters(':vanId', $vanId)
            ->getQuery()
            ->getResult();

    }
}