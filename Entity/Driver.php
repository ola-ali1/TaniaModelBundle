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

    public static $statuses = array('0' => 'offline', '1' => 'online');

    /**
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order", mappedBy="driver")
     */
    protected $orders;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\VanDriver",mappedBy="driver", cascade={"persist", "remove"})
     */
    protected $vanDrivers;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\DriverCityArea",mappedBy="driver", cascade={"persist", "remove"})
     */
    protected $driverCityAreas;

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
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", options={"default": true})
     */
    protected $status = true;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->orders = new ArrayCollection();
        $this->vanDrivers = new ArrayCollection();
        $this->driverCityAreas = new ArrayCollection();
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
     * Add vanDriver
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\VanDriver $vanDriver
     *
     * @return Van
     */
    public function addVanDriver(\Ibtikar\TaniaModelBundle\Entity\VanDriver $vanDriver)
    {
        $this->vanDrivers[] = $vanDriver;

        $vanDriver->setDriver($this);

        return $this;
    }

    /**
     * Remove vanDriver
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\VanDrivers $vanDriver
     */
    public function removeVanDriver(\Ibtikar\TaniaModelBundle\Entity\VanDriver $vanDriver)
    {
        $this->vanDrivers->removeElement($vanDriver);
    }

    /**
     * Get vanDrivers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVanDrivers()
    {
        return $this->vanDrivers;
    }

    /**
     * Add driverCityArea
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\DriverCityArea $driverCityArea
     *
     * @return Van
     */
    public function addDriverCityArea(\Ibtikar\TaniaModelBundle\Entity\DriverCityArea $driverCityArea)
    {
        $this->driverCityAreas[] = $driverCityArea;

        $driverCityArea->setDriver($this);

        return $this;
    }

    /**
     * Remove driverCityArea
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\DriverCityArea $driverCityArea
     */
    public function removeDriverCityArea(\Ibtikar\TaniaModelBundle\Entity\DriverCityArea $driverCityArea)
    {
        $this->driverCityAreas->removeElement($driverCityArea);
    }

    /**
     * Get driverCityAreas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDriverCityAreas()
    {
        return $this->driverCityAreas;
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

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Driver
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getVanNumber()
    {
        if(count($this->vanDrivers)> 0)
            return $this->vanDrivers[0]->getVanNumber();
        return '';
    }

    /**
     *
     * @return array
     */
    public function getStatuses()
    {
        return self::$statuses;
    }

    /**
     *
     * @return string
     */
    public function getStatusString()
    {
        return self::$statuses[$this->status ? '1' : '0'];
    }

}
