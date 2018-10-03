<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="item_excluded_cityarea")
 * @ORM\Entity()
 */
class ItemExcludedCityArea
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
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Item", inversedBy="itemExcludedCityAreas")
     */
    protected $item;


    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\CityArea", inversedBy="itemExcludedCityAreas")
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
     * Set item
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Item $item
     *
     * @return ItemExcludedCityArea
     */
    public function setItem(\Ibtikar\TaniaModelBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\CityArea $cityArea
     *
     * @return ItemExcludedCityArea
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

}
