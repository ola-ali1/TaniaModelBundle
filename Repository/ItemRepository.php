<?php

namespace Ibtikar\TaniaModelBundle\Repository;

use \Doctrine\ORM\EntityRepository;

class ItemRepository extends EntityRepository
{
    function getItemsNotAssignedToVan($vanId)
    {
        return $this->createQueryBuilder('i')
            ->select('i, vanItems.id')
            ->leftJoin('i.vanItems', 'vanItems','WITH','vanItems.van = :vanId')
            ->andWhere('vanItems.id is NULL')
            ->setParameter(':vanId', $vanId)
            ->getQuery()
            ->getResult();

    }

    function getVanItems($vanId)
    {
        return $this->createQueryBuilder('i')
            ->select('i as item, vanItems.currentCapacity, vanItems.capacity')
            ->innerJoin('i.vanItems', 'vanItems','WITH','vanItems.van = :vanId')
            ->setParameter(':vanId', $vanId)
            ->andWhere('i.shown = 1')
            ->getQuery()
            ->getResult();

    }

    function getSimilarItems($item)
    {
        /* @var $item \Ibtikar\TaniaModelBundle\Entity\Item */
        $attr = $item->getAttribute();
        $brand = $item->getBrand();
        $package = $item->getPackage();
        $packageSize = $item->getPackageSize();
        $type = $item->getType();
        $queryBuilder = $this->createQueryBuilder('i');
        if (!($attr || $brand || $package || $package || $package || $packageSize)) {
            return $queryBuilder->andWhere('0 = 1')->getQuery()->getResult();
        }
        if ($attr) {
            $queryBuilder = $queryBuilder->orWhere('i.attribute = :attribute')->setParameter(':attribute', $attr);
        }if ($brand) {
            $queryBuilder = $queryBuilder->orWhere('i.brand = :brand')->setParameter(':brand', $brand);
        }if ($package) {
            $queryBuilder = $queryBuilder->orWhere('i.package = :package')->setParameter(':package', $package);
        }if ($packageSize) {
            $queryBuilder = $queryBuilder->orWhere('i.packageSize = :packageSize')->setParameter(':packageSize', $packageSize);
        }if ($type) {
            $queryBuilder = $queryBuilder->orWhere('i.type = :type')->setParameter(':type', $type);
        }
        $queryBuilder = $queryBuilder->andWhere('i.shown = 1');
        return $queryBuilder->getQuery()->getResult();
    }
}