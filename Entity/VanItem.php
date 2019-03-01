<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="van_item")
 * @ORM\Entity()
 */
class VanItem
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
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Item", inversedBy="vanItems")
     */
    protected $item;


    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Van", inversedBy="vanItems")
     */
    protected $van;

    /**
     * @ORM\Column(name="capacity", type="integer")
     * @Assert\NotBlank(message="fill_mandatory_field")
     */
    private $capacity;

    /**
     * @ORM\Column(name="current_capacity", type="integer", options={"default": 0})
     */
    private $currentCapacity;


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
     * @return VanItem
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
     * @param \Ibtikar\TaniaModelBundle\Entity\Van $van
     *
     * @return VanItem
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
     * Set capacity
     *
     * @param string $capacity
     *
     * @return VanItem
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set currentCapacity
     *
     * @param string $currentCapacity
     *
     * @return VanItem
     */
    public function setCurrentCapacity($currentCapacity)
    {
        $this->currentCapacity = $currentCapacity;

        return $this;
    }

    /**
     * Get currentCapacity
     *
     * @return string
     */
    public function getCurrentCapacity()
    {
        return $this->currentCapacity;
    }
}
