<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\Common\Util\Debug;
use Symfony\Component\Validator\Constraints AS Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Package
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Table(name="package")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\PackageRepository")
 */
class Package
{

    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    public function __construct()
    {
        $this->packageBuyItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orderPackages   = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @Assert\Length(min = 4, max = 100, maxMessage="packageTitle_length_not_valid", minMessage="packageTitle_length_not_valid")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 4, max = 100, maxMessage="packageTitle_length_not_valid", minMessage="packageTitle_length_not_valid")
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
     * Assert\DateTime
     * Assert\Range(min="now")
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
     *
     * @Assert\NotBlank
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\PackageBuyItem",mappedBy="package")
     */
    protected $packageBuyItems;

    /**
     * @var int
     *
     * @ORM\Column(name="number_of_used_times", type="integer", options={"default": 0})
     */
    private $numberOfUsedTimes = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="get_amount", type="integer", options={"default": 0}, nullable = true)
     * @Assert\Type(type="numeric")
     */
    private $getAmount;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", options={"default": true})
     */
    private $enabled = true;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderPackage",mappedBy="package")
     */
    protected $orderPackages;

    /**
     * @var \DateTime $deletedAt
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\UserPackage", mappedBy="package")
     */
    private $userPackages;
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
     * Add packageBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\PackageBuyItem $packageBuyItem
     *
     * @return PackageBuyItem
     */
    public function addPackageBuyItem(PackageBuyItem $packageBuyItem)
    {
        $this->packageBuyItems[] = $packageBuyItem;

        return $this;
    }

    /**
     * Remove packageBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\PackageBuyItem $packageBuyItem
     */
    public function removePackageBuyItem(PackageBuyItem $packageBuyItem)
    {
        $this->packageBuyItems->removeElement($packageBuyItem);
    }

    /**
     * Get packageBuyItems
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPackageBuyItems()
    {
        return $this->packageBuyItems;
    }

    public function getBuyItemsIds()
    {
        $packageItemIds = [];
        foreach ($this->packageBuyItems as $pbi) {
            $packageItemIds[] = $pbi->getItem()->getId();
        }
        return $packageItemIds;
    }

    public function findPackageBuyItemByItemId($itemId) {
        foreach ($this->packageBuyItems as $pbi) {
            if ($itemId == $pbi->getItem()->getId()) {
                return $pbi;
            }
        }
        return false;
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
    public function getGetAmount()
    {
        return $this->getAmount;
    }

    /**
     * @param float $getAmount
     */
    public function setGetAmount($getAmount)
    {
        $this->getAmount = $getAmount;
        return $this;
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
    public function getPackageBuyItemsNamesAndQuantitiesEn()
    {
        $itemsString = '';
        foreach ($this->packageBuyItems as $item) {
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
    public function getPackageBuyItemsNamesAndQuantitiesAr()
    {
        $itemsString = '';
        foreach ($this->packageBuyItems as $item) {
            if (strlen($itemsString) !== 0) {
                $itemsString .= '<br/>';
            }
            $itemsString .= '(' . $item->getCount() . ') '. $item->getName();
        }
        return $itemsString;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistCallback()
    {
        $this->startTime = $this->startTime ? $this->startTime : new \DateTime('now');;
    }

    public function getTotalItemCount()
    {
        return $this->packageBuyItems->count();
    }

    public function getPackagePrice()
    {
        $value = 0;
        /* @var PackageBuyItem $buyItem */
        foreach($this->packageBuyItems as $buyItem)
        {
            $value += (double)$buyItem->getPrice() * $buyItem->getCount();
        }
        return $value;
    }

    /**
     * Add orderPackage
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderPackage $orderPackage
     *
     * @return Package
     */
    public function addOrderPackage(\Ibtikar\TaniaModelBundle\Entity\OrderPackage $orderPackage)
    {
        $this->orderPackages[] = $orderPackage;

        return $this;
    }

    /**
     * Remove orderPackage
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderPackage $orderPackage
     */
    public function removeOrderPackage(\Ibtikar\TaniaModelBundle\Entity\OrderPackage $orderPackage)
    {
        $this->orderPackages->removeElement($orderPackage);
    }

    /**
     * Get orderPackages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderPackages()
    {
        return $this->orderPackages;
    }
    
    public function getEnabledString() 
    {
        return ($this->enabled == 0) ? "No" : "Yes";
    }

    /**    
     * @return Package
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
