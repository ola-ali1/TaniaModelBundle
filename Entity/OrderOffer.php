<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * OrderOffer
 *
 * @ORM\Table(name="order_offer")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\OrderOfferRepository")
 */
class OrderOffer
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderOfferBuyItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orderOfferGetItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Offer", inversedBy="orderOffes")
     */
    protected $offer;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order", inversedBy="orderOffes")
     */
    protected $order;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=100, nullable=true)
     */
    private $titleEn;

    /**
     * @var string
     *
     * @ORM\Column(name="description_public", type="text", nullable=true)
     */
    private $descriptionPublic;

    /**
     * @var string
     *
     * @ORM\Column(name="description_public_en", type="text", nullable=true)
     */
    private $descriptionPublicEn;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="cash_get_amount", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $cashGetAmount;

    /**
     * @var float
     *
     * @ORM\Column(name="percentage_get_amount", type="float", nullable=true)
     */
    private $percentageGetAmount;

    /**
     *
     * @Assert\NotBlank
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderOfferBuyItem",mappedBy="orderOffer")
     */
    protected $orderOfferBuyItems;

    /**
     *
     * @Assert\Expression("this.getType() != 'ITEM' or value != null", message="This value should not be blank.")
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderOfferGetItem",mappedBy="orderOffer")
     */
    protected $orderOfferGetItems;

    /**
     * @ORM\Column(name="count", type="integer", options={"default": 0})
     */
    private $count;

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
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
     * Set price
     *
     * @param string $price
     *
     * @return OrderOffer
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
     * Set title
     *
     * @param string $title
     *
     * @return OrderOffer
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleEn
     *
     * @param string $titleEn
     *
     * @return OrderOffer
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;

        return $this;
    }

    /**
     * Get titleEn
     *
     * @return string
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * Set descriptionPublic
     *
     * @param string $descriptionPublic
     *
     * @return OrderOffer
     */
    public function setDescriptionPublic($descriptionPublic)
    {
        $this->descriptionPublic = $descriptionPublic;

        return $this;
    }

    /**
     * Get descriptionPublic
     *
     * @return string
     */
    public function getDescriptionPublic()
    {
        return $this->descriptionPublic;
    }

    /**
     * Set descriptionPublicEn
     *
     * @param string $descriptionPublicEn
     *
     * @return OrderOffer
     */
    public function setDescriptionPublicEn($descriptionPublicEn)
    {
        $this->descriptionPublicEn = $descriptionPublicEn;

        return $this;
    }

    /**
     * Get descriptionPublicEn
     *
     * @return string
     */
    public function getDescriptionPublicEn()
    {
        return $this->descriptionPublicEn;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return OrderOffer
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set cashGetAmount
     *
     * @param string $cashGetAmount
     *
     * @return OrderOffer
     */
    public function setCashGetAmount($cashGetAmount)
    {
        $this->cashGetAmount = $cashGetAmount;

        return $this;
    }

    /**
     * Get cashGetAmount
     *
     * @return string
     */
    public function getCashGetAmount()
    {
        return $this->cashGetAmount;
    }

    /**
     * Set percentageGetAmount
     *
     * @param float $percentageGetAmount
     *
     * @return OrderOffer
     */
    public function setPercentageGetAmount($percentageGetAmount)
    {
        $this->percentageGetAmount = $percentageGetAmount;

        return $this;
    }

    /**
     * Get percentageGetAmount
     *
     * @return float
     */
    public function getPercentageGetAmount()
    {
        return $this->percentageGetAmount;
    }


    /**
     * Add orderOrderOfferBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderOfferBuyItem $orderOrderOfferBuyItem
     *
     * @return OrderOfferBuyItem
     */
    public function addOrderOfferBuyItem(OrderOfferBuyItem $orderOrderOfferBuyItem)
    {
        $this->orderOrderOfferBuyItems[] = $orderOrderOfferBuyItem;

        return $this;
    }

    /**
     * Remove orderOrderOfferBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderOfferBuyItem $orderOrderOfferBuyItem
     */
    public function removeOrderOfferBuyItem(OrderOfferBuyItem $orderOrderOfferBuyItem)
    {
        $this->orderOrderOfferBuyItems->removeElement($orderOrderOfferBuyItem);
    }

    /**
     * Get orderOrderOfferBuyItems
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOrderOfferBuyItems()
    {
        return $this->orderOrderOfferBuyItems;
    }

    /**
     * Add orderOrderOfferGetItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderOfferGetItem $orderOfferGetItem
     *
     * @return OrderOfferGetItem
     */
    public function addOrderOfferGetItem(OrderOfferGetItem $orderOfferGetItem)
    {
        $this->orderOfferGetItems[] = $orderOfferGetItem;

        return $this;
    }

    /**
     * Remove orderOrderOfferGetItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderOfferGetItem $orderOfferGetItem
     */
    public function removeOrderOfferGetItem(OrderOfferGetItem $orderOfferGetItem)
    {
        $this->orderOfferGetItems->removeElement($orderOfferGetItem);
    }

    /**
     * Get orderOfferGetItems
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOrderOfferGetItems()
    {
        return $this->orderOfferGetItems;
    }

    /**
     * Set offer
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Offer $offer
     *
     * @return OrderOffer
     */
    public function setOffer(\Ibtikar\TaniaModelBundle\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Set order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     *
     * @return OrderOffer
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
     * @ORM\PostPersist
     */
    public function postPersistCallback(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        /* @var Offer $offer */
        $offer = $this->offer;

        /* @var OfferBuyItem $buyItem */
        foreach ($offer->getOfferBuyItems() as $buyItem) {
            /* @var $orderOfferBuyItem OrderOfferBuyItem */
            $orderOfferBuyItem = new OrderOfferBuyItem();
            $orderOfferBuyItem->setPrice($buyItem->getPrice());
            $orderOfferBuyItem->setName($buyItem->getName());
            $orderOfferBuyItem->setNameEn($buyItem->getNameEn());
            $orderOfferBuyItem->setCount($buyItem->getCount());
            $orderOfferBuyItem->setItem($buyItem->getItem());
            $orderOfferBuyItem->setOrderOffer($this);

            $em->persist($orderOfferBuyItem);
        }

        if($this->type == Offer::TYPE_ITEM){
            /* @var OfferGetItem $getItem */
            foreach ($offer->getOfferGetItems() as $getItem) {
                /* @var $orderOfferGetItem OrderOfferGetItem */
                $orderOfferGetItem = new OrderOfferGetItem();
                $orderOfferGetItem->setPrice($getItem->getPrice());
                $orderOfferGetItem->setName($getItem->getName());
                $orderOfferGetItem->setNameEn($getItem->getNameEn());
                $orderOfferGetItem->setCount($getItem->getCount());
                $orderOfferGetItem->setItem($getItem->getItem());
                $orderOfferGetItem->setOrderOffer($this);

                $em->persist($orderOfferGetItem);
            }
        }
        $em->flush();
    }
}
