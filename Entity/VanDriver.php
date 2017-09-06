<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="van_driver")
 * @ORM\Entity()
 */
class VanDriver
{
    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Driver", inversedBy="vanDrivers")
     */
    protected $driver;


    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Van", inversedBy="vanDrivers")
     */
    protected $van;

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set driver
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Driver $driver
     *
     * @return VanDriver
     */
    public function setDriver(\Ibtikar\TaniaModelBundle\Entity\Driver $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Van $van
     *
     * @return VanDriver
     */
    public function setVan(\Ibtikar\TaniaModelBundle\Entity\Van $van = null)
    {
        $this->van = $van;

        return $this;
    }

    /**
     * Get van
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Van
     */
    public function getVan()
    {
        return $this->van;
    }

    /**
     * Get vanNumber
     *
     * @return string
     */
    public function getVanNumber()
    {
        return $this->van->getVanNumber();
    }

    /**
     * Get totalCapacity
     *
     * @return string
     */
    public function getTotalCapacity()
    {
        return $this->van->getTotalCapacity();
    }

    /**
     * Get currentCapacity
     *
     * @return string
     */
    public function getCurrentCapacity()
    {
        return $this->van->getCurrentCapacity();
    }
}
