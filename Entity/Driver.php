<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Driver extends User
{

    /**
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order", mappedBy="driver")
     */
    protected $orders;
//stodo cascade
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ibtikar\TaniaModelBundle\Entity\Van", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"id"="DESC"})
     * @ORM\JoinTable(name="van_drivers",
     *  joinColumns={@ORM\JoinColumn(name="driver_id", referencedColumnName="id", onDelete="CASCADE")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="van_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     *
     * @Assert\Valid
     */
    protected $vans;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->orders = new ArrayCollection();
        $this->vans = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     *
     * @return Driver
     */
    public function addOrder(\Ibtikar\TaniaModelBundle\Entity\Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     */
    public function removeOrder(\Ibtikar\TaniaModelBundle\Entity\Order $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Add van
     *
     * @param Van $van
     *
     * @return Driver
     */
    public function addVan(Van $van)
    {
        $this->vans[] = $van;

        return $this;
    }

    /**
     * Remove van
     *
     * @param Van van
     */
    public function removeVan(Van $van)
    {
        $this->vans->removeElement($van);
    }

    /**
     * Get vans
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVans()
    {
        return $this->vans;
    }

}
