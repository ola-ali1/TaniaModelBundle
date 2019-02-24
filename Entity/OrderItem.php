<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="order_item")
 * @ORM\Entity()
 */
class OrderItem
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
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Item", inversedBy="orderItems")
     */
    protected $item;


    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order", inversedBy="orderItems")
     */
    protected $order;

    /**
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     * @Assert\Type(type="numeric")
     */
    private $price;

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
     * Set city
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\City $city
     *
     * @return City
     */
    public function setCity(\Ibtikar\TaniaModelBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set item
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Item $item
     *
     * @return Item
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
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     *
     * @return Order
     */
    public function setOrder(\Ibtikar\TaniaModelBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set count
     *
     * @param string $count
     *
     * @return Count
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Price
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
}
