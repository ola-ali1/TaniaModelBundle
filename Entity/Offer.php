<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Symfony\Component\Validator\Constraints AS Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
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
        self::TYPE_CASH_PERCENTAGE,
        self::TYPE_CASH_AMOUNT,
        self::TYPE_ITEM,
    );


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offerBuyItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offerGetItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @Assert\Length(min = 3, max = 20, maxMessage="offerTitle_length_not_valid", minMessage="offerTitle_length_not_valid")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 3, max = 20, maxMessage="offerTitle_length_not_valid", minMessage="offerTitle_length_not_valid")
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
     * @Assert\NotBlank
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
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OfferBuyItem",mappedBy="offer")
     */
    protected $offerBuyItems;

    /**
     *
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
            $itemsString .= '(' . $item->getCount() . ') '. $item->getItem()->getNameEn();
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
            $itemsString .= '(' . $item->getCount() . ') '. $item->getItem()->getName();
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
            $itemsString .= '(' . $item->getCount() . ') '. $item->getItem()->getNameEn();
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
            $itemsString .= '(' . $item->getCount() . ') '. $item->getItem()->getName();
        }
        return $itemsString;
    }

}
