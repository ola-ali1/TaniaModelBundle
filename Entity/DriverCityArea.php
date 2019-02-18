<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="cityArea_driver")
 * @ORM\Entity()
 */
class DriverCityArea
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
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Driver", inversedBy="driverCityAreas")
     */
    protected $driver;


    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\CityArea", inversedBy="driverCityAreas")
     */
    protected $cityArea;

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
     * @return DriverCityArea
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
     * @param \Ibtikar\TaniaModelBundle\Entity\CityArea $cityArea
     *
     * @return DriverCityArea
     */
    public function setCityArea(\Ibtikar\TaniaModelBundle\Entity\CityArea $cityArea = null)
    {
        $this->cityArea = $cityArea;

        return $this;
    }

    /**
     * Get cityArea
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\CityArea
     */
    public function getCityArea()
    {
        return $this->cityArea;
    }

    /**
     * Get cityAreaNumber
     *
     * @return string
     */
    public function getCityAreaNumber()
    {
        return $this->cityArea->getCityAreaNumber();
    }

    /**
     * Get totalCapacity
     *
     * @return string
     */
    public function getTotalCapacity()
    {
        return $this->cityArea->getTotalCapacity();
    }
}
