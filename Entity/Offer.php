<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\Common\Util\Debug;
use Symfony\Component\Validator\Constraints AS Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Offer
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Table(name="offer")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\OfferRepository")
 */
class Offer
{

    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    const TYPE_ITEM            = 'ITEM';
    const TYPE_CASH_PERCENTAGE = 'PERCENTAGE';
    const TYPE_CASH_AMOUNT     = 'CASH';

    public static $typeCategories = array(
        'cash'  => array(self::TYPE_CASH_PERCENTAGE, self::TYPE_CASH_AMOUNT),
        'items' => array(self::TYPE_ITEM)
    );

    public static $types = array(
        self::TYPE_CASH_PERCENTAGE => "PERCENTAGE",
        self::TYPE_CASH_AMOUNT => "CASH",
        self::TYPE_ITEM => "ITEM",
    );


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offerBuyItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offerGetItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orderOffers   = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 4, max = 100, maxMessage="offerTitle_length_not_valid", minMessage="offerTitle_length_not_valid")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 4, max = 100, maxMessage="offerTitle_length_not_valid", minMessage="offerTitle_length_not_valid")
     */
    private $titleEn;

    /**
     * @var text
     *
     * @ORM\Column(name="description_private", type="text", nullable=true)
     */
    private $descriptionPrivate;

    /**
     * @var text
     *
     * @ORM\Column(name="description_public", type="text", nullable=true)
     */
    private $descriptionPublic;

    /**
     * @var text
     *
     * @ORM\Column(name="description_private_en", type="text", nullable=true)
     */
    private $descriptionPrivateEn;

    /**
     * @var text
     *
     * @ORM\Column(name="description_public_en", type="text", nullable=true)
     */
    private $descriptionPublicEn;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime
     * @Assert\Range(min="now")
     * @ORM\Column(name="start_time", type="datetime", nullable=true)
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank
     * @Assert\DateTime
     * @Assert\Range(min="+1 hour")
     * @ORM\Column(name="expiry_time", type="datetime", nullable=true)
     */
    private $expiryTime;

    /**
     * @var string
     *
     * @Assert\Choice(callback="getTypes")
     * @Assert\NotBlank
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     *
     * @Assert\NotBlank
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OfferBuyItem",mappedBy="offer")
     */
    protected $offerBuyItems;

    /**
     *
     * @Assert\Expression("this.getType() != 'ITEM' or value != null", message="This value should not be blank.")
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OfferGetItem",mappedBy="offer")
     */
    protected $offerGetItems;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order",mappedBy="offer")
     */
    protected $orders;

    /**
     * @var int
     *
     * @ORM\Column(name="number_of_used_times", type="integer", options={"default": 0})
     */
    private $numberOfUsedTimes = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="cash_get_amount", type="decimal", precision=10, scale=2, options={"default": 0}, nullable = true)
     * @Assert\Type(type="numeric")
     */
    private $cashGetAmount;

    /**
     * @var float
     *
     * @Assert\Expression("this.getType() != 'PERCENTAGE' or value != null", message="This value should not be blank.")
     * @ORM\Column(name="percentage_get_amount", type="float", options={"default": 0}, nullable = true)
     * @Assert\Type(type="numeric")
     */
    private $percentageGetAmount;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", options={"default": true})
     */
    private $enabled = true;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderOffer",mappedBy="offer")
     */
    protected $orderOffers;

    /**
     * @var \DateTime $deletedAt
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

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
     * Set type
     *
     * @param string $type
     *
     * @return Offer
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * @param string $titleEn
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }


    /**
     * @return text
     */
    public function getDescriptionPrivate()
    {
        return $this->descriptionPrivate;
    }

    /**
     * @param text $descriptionPrivate
     */
    public function setDescriptionPrivate($descriptionPrivate)
    {
        $this->descriptionPrivate = $descriptionPrivate;
    }

    /**
     * @return text
     */
    public function getDescriptionPublic()
    {
        return $this->descriptionPublic;
    }

    /**
     * @param text $descriptionPublic
     */
    public function setDescriptionPublic($descriptionPublic)
    {
        $this->descriptionPublic = $descriptionPublic;
    }


    /**
     * @return text
     */
    public function getDescriptionPrivateEn()
    {
        return $this->descriptionPrivateEn;
    }

    /**
     * @param text $descriptionPrivateEn
     */
    public function setDescriptionPrivateEn($descriptionPrivateEn)
    {
        $this->descriptionPrivateEn = $descriptionPrivateEn;
    }

    /**
     * @return text
     */
    public function getDescriptionPublicEn()
    {
        return $this->descriptionPublicEn;
    }

    /**
     * @param text $descriptionPublicEn
     */
    public function setDescriptionPublicEn($descriptionPublicEn)
    {
        $this->descriptionPublicEn = $descriptionPublicEn;
    }

    /**
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param \DateTime $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return \DateTime
     */
    public function getExpiryTime()
    {
        return $this->expiryTime;
    }

    /**
     * @param \DateTime $expiryTime
     */
    public function setExpiryTime($expiryTime)
    {
        $this->expiryTime = $expiryTime;
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return self::$types;
    }

    /**
     * Add offerBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OfferBuyItem $offerBuyItem
     *
     * @return OfferBuyItem
     */
    public function addOfferBuyItem(OfferBuyItem $offerBuyItem)
    {
        $this->offerBuyItems[] = $offerBuyItem;

        return $this;
    }

    /**
     * Remove offerBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OfferBuyItem $offerBuyItem
     */
    public function removeOfferBuyItem(OfferBuyItem $offerBuyItem)
    {
        $this->offerBuyItems->removeElement($offerBuyItem);
    }

    /**
     * Get offerBuyItems
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOfferBuyItems()
    {
        return $this->offerBuyItems;
    }

    /**
     * Add offerGetItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OfferGetItem $offerGetItem
     *
     * @return OfferGetItem
     */
    public function addOfferGetItem(OfferGetItem $offerGetItem)
    {
        $this->offerGetItems[] = $offerGetItem;

        return $this;
    }

    /**
     * Remove offerGetItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OfferGetItem $offerGetItem
     */
    public function removeOfferGetItem(OfferGetItem $offerGetItem)
    {
        $this->offerGetItems->removeElement($offerGetItem);
    }

    /**
     * Get offerGetItems
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOfferGetItems()
    {
        return $this->offerGetItems;
    }

    /**
     * @return int
     */
    public function getNumberOfUsedTimes()
    {
        return $this->numberOfUsedTimes;
    }

    /**
     * @param int $numberOfUsedTimes
     */
    public function setNumberOfUsedTimes($numberOfUsedTimes)
    {
        $this->numberOfUsedTimes = $numberOfUsedTimes;
    }

    /**
     * @return float
     */
    public function getCashGetAmount()
    {
        return $this->cashGetAmount;
    }

    /**
     * @param float $cashGetAmount
     */
    public function setCashGetAmount($cashGetAmount)
    {
        $this->cashGetAmount = $cashGetAmount;
    }

    /**
     * @return float
     */
    public function getPercentageGetAmount()
    {
        return $this->percentageGetAmount;
    }

    /**
     * @param float $percentageGetAmount
     */
    public function setPercentageGetAmount($percentageGetAmount)
    {
        $this->percentageGetAmount = $percentageGetAmount;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "$this->id";
    }

    /**
     * @return string
     */
    public function getOfferGetItemsNamesAndQuantitiesEn()
    {
        $itemsString = '';
        foreach ($this->offerGetItems as $item) {
            if (strlen($itemsString) !== 0) {
                $itemsString .= '<br/>';
            }
            $itemsString .= '(' . $item->getCount() . ') '. $item->getNameEn();
        }
        return $itemsString;
    }

    /**
     * @return string
     */
    public function getOfferGetItemsNamesAndQuantitiesAr()
    {
        $itemsString = '';
        foreach ($this->offerGetItems as $item) {
            if (strlen($itemsString) !== 0) {
                $itemsString .= '<br/>';
            }
            $itemsString .= '(' . $item->getCount() . ') '. $item->getName();
        }
        return $itemsString;
    }
    
    /**
     * @return string
     */
    public function getOfferBuyItemsNamesAndQuantitiesEn()
    {
        $itemsString = '';
        foreach ($this->offerBuyItems as $item) {
            if (strlen($itemsString) !== 0) {
                $itemsString .= '<br/>';
            }
            $itemsString .= '(' . $item->getCount() . ') '. $item->getNameEn();
        }
        return $itemsString;
    }

    /**
     * @return string
     */
    public function getOfferBuyItemsNamesAndQuantitiesAr()
    {
        $itemsString = '';
        foreach ($this->offerBuyItems as $item) {
            if (strlen($itemsString) !== 0) {
                $itemsString .= '<br/>';
            }
            $itemsString .= '(' . $item->getCount() . ') '. $item->getName();
        }
        return $itemsString;
    }

    public function getAmount() 
    {
        switch ($this->type) {
            case self::TYPE_CASH_AMOUNT:
                return $this->getCashGetAmount();
                break;
            case self::TYPE_CASH_PERCENTAGE:
                return $this->getPercentageGetAmount() * 100 . " %";
                break;
            default:
            case self::TYPE_ITEM:
                return "item";
                break;
        }
        
       
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistCallback()
    {
        $this->startTime = $this->startTime ? $this->startTime : new \DateTime('now');;
    }

    /**
     * Add order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     *
     * @return Offer
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

    public function getTotalItemCount()
    {
        return $this->offerBuyItems->count() + $this->offerGetItems->count();
    }

    public function getOfferPrice()
    {
        $value = 0;

        /* @var OfferBuyItem $buyItem */
        foreach($this->offerBuyItems as $buyItem)
        {
            $value += (double)$buyItem->getPrice() * $buyItem->getCount();
        }

        if($this->type == self::TYPE_CASH_PERCENTAGE){
            $value = max(0, $value - $value * $this->percentageGetAmount);
        }

        if($this->type == self::TYPE_CASH_AMOUNT){
            $value = $value + $this->cashGetAmount;
        }

        return $value;
    }

    /**
     * Add orderOffer
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderOffer $orderOffer
     *
     * @return Offer
     */
    public function addOrderOffer(\Ibtikar\TaniaModelBundle\Entity\OrderOffer $orderOffer)
    {
        $this->orderOffers[] = $orderOffer;

        return $this;
    }

    /**
     * Remove orderOffer
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderOffer $orderOffer
     */
    public function removeOrderOffer(\Ibtikar\TaniaModelBundle\Entity\OrderOffer $orderOffer)
    {
        $this->orderOffers->removeElement($orderOffer);
    }

    /**
     * Get orderOffers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderOffers()
    {
        return $this->orderOffers;
    }
    
    public function getEnabledString() 
    {
        return ($this->enabled == 0) ? "No" : "Yes";
    }

    /**    
     * @return Offer
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
    
}
