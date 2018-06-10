<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="order_offer_get_item")
 * @ORM\Entity()
 */
class OrderOfferGetItem
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
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Item", inversedBy="orderOfferGetItems")
     */
    protected $item;


    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderOffer", inversedBy="orderOfferGetItems")
     *
     * @ORM\JoinColumn(name="order_offer_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $orderOffer;

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
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\Column(name="name_en", type="string")
     */
    private $nameEn;


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
     * Set orderOffer
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderOffer $orderOffer
     *
     * @return OrderOffer
     */
    public function setOrderOffer(\Ibtikar\TaniaModelBundle\Entity\OrderOffer $orderOffer = null)
    {
        $this->orderOffer = $orderOffer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Offer
     */
    public function getOrderOffer()
    {
        return $this->orderOffer;
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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param mixed $nameEn
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
    }

    public function __toString() {
        return $this->name;
    }
}
