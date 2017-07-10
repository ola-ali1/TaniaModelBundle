<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\DriverRepository")
 * @UniqueEntity(fields={"username"}, groups={"username"}, message="username_exist")
 */
class Driver extends User
{

    /**
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order", mappedBy="driver")
     */
    protected $orders;

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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100, nullable=true)
     *
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"username"})
     * @Assert\Length(min = 4, max = 12, groups={"username"}, maxMessage="username_length_not_valid", minMessage="username_length_not_valid")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_rate", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $driverRate;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->orders = new ArrayCollection();
        $this->vans = new ArrayCollection();
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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }


    /**
     * Set driverRate
     *
     * @param string $driverRate
     *
     * @return Driver
     */
    public function setDriverRate($driverRate)
    {
        $this->driverRate = $driverRate;

        return $this;
    }

    /**
     * Get driverRate
     *
     * @return string
     */
    public function getDriverRate()
    {
        return $this->driverRate;
    }
}
