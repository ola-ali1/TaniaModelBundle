<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemHome
 *
 * @ORM\Table(name="item_home")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\ItemHomeRepository")
 */
class ItemHome
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Item", inversedBy="itemHome")
     */
    protected $item;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;


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
     * @param string $item
     *
     * @return ItemHome
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return ItemHome
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }
}