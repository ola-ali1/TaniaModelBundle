<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints AS Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\GroupSequenceProviderInterface;

/**
 * PromoCode
 *
 * @Assert\GroupSequenceProvider
 * @ORM\Table(name="promo_code")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\PromoCodeRepository")
 * @UniqueEntity(fields={"code"})
 */
class PromoCode implements GroupSequenceProviderInterface
{

    use \Ibtikar\ShareEconomyToolsBundle\Entity\TrackableTrait;

    const PROMOCODE_TYPE_FIXED_VALUE = 'fixed-value';
    const PROMOCODE_TYPE_PERCENTAGE = 'percentage';

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
     * @Assert\NotBlank
     * @Assert\Choice(callback="getTypes")
     * @ORM\Column(name="type", type="string", length=11, options={"comment": "available types are fixed-value and percentage"})
     */
    private $type = PromoCode::PROMOCODE_TYPE_FIXED_VALUE;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=190)
     * @ORM\Column(name="title", type="string", length=190)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=20)
     * @ORM\Column(name="code", type="string", length=20, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Range(min=1, max=100, groups={"percentage"})
     * @Assert\Range(min=1, max=999999, groups={"fixed-value"})
     * @ORM\Column(name="discountAmount", type="decimal", precision=8, scale=2, options={"comment": "Based on type the maximum value should be either 100 or 999999"})
     */
    private $discountAmount;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank
     * @Assert\DateTime
     * @Assert\Range(min="+1 hour")
     * @ORM\Column(name="expiryTime", type="datetime", nullable=true)
     */
    private $expiryTime;

    /**
     * @var int
     *
     * @Assert\Range(min=1, max=30)
     * @ORM\Column(name="activeDurationInDaysAfterTheAddByUser", type="integer", nullable=true)
     */
    private $activeDurationInDaysAfterTheAddByUser;

    /**
     * @var int
     *
     * @Assert\Range(min=1, max=999999)
     * @ORM\Column(name="maximumNumberOfAllowedTimesPerUser", type="integer", nullable=true)
     */
    private $maximumNumberOfAllowedTimesPerUser;

    /**
     * @var int
     *
     * @Assert\Range(min=1, max=999999)
     * @ORM\Column(name="maximumNumberOfUsersAllowedToUse", type="integer", nullable=true)
     */
    private $maximumNumberOfUsersAllowedToUse;

    /**
     * @var int
     *
     * @Assert\Expression("value == null or value >= this.getMaximumNumberOfAllowedTimesPerUser()", message="This value must be larger than or equal to maximum number of allowed times per user")
     * @Assert\Range(min=1, max=999999)
     * @ORM\Column(name="maximumAllowedTimesForAllUsers", type="integer", nullable=true)
     */
    private $maximumAllowedTimesForAllUsers;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfUsedByUsers", type="integer", options={"default": 0})
     */
    private $numberOfUsedByUsers = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfUsedTimes", type="integer", options={"default": 0})
     */
    private $numberOfUsedTimes = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="usageTotalAmount", type="decimal", precision=12, scale=2, options={"default": 0})
     */
    private $usageTotalAmount = 0;

    /**
     * @var bool
     *
     * @ORM\Column(name="sendToAllUsers", type="boolean", options={"default": 0})
     */
    private $sendToAllUsers = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", options={"default": 1})
     */
    protected $enabled = true;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title ? $this->title : '';
    }

    /**
     * Get id
     *
     * @return integer
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
     * @return PromoCode
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
     * Set title
     *
     * @param string $title
     *
     * @return PromoCode
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
     * Set code
     *
     * @param string $code
     *
     * @return PromoCode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set discountAmount
     *
     * @param string $discountAmount
     *
     * @return PromoCode
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;

        return $this;
    }

    /**
     * Get discountAmount
     *
     * @return string
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * Set expiryTime
     *
     * @param \DateTime $expiryTime
     *
     * @return PromoCode
     */
    public function setExpiryTime($expiryTime)
    {
        $this->expiryTime = $expiryTime;

        return $this;
    }

    /**
     * Get expiryTime
     *
     * @return \DateTime
     */
    public function getExpiryTime()
    {
        return $this->expiryTime;
    }

    /**
     * Set activeDurationInDaysAfterTheAddByUser
     *
     * @param integer $activeDurationInDaysAfterTheAddByUser
     *
     * @return PromoCode
     */
    public function setActiveDurationInDaysAfterTheAddByUser($activeDurationInDaysAfterTheAddByUser)
    {
        $this->activeDurationInDaysAfterTheAddByUser = $activeDurationInDaysAfterTheAddByUser;

        return $this;
    }

    /**
     * Get activeDurationInDaysAfterTheAddByUser
     *
     * @return integer
     */
    public function getActiveDurationInDaysAfterTheAddByUser()
    {
        return $this->activeDurationInDaysAfterTheAddByUser;
    }

    /**
     * Set maximumNumberOfAllowedTimesPerUser
     *
     * @param integer $maximumNumberOfAllowedTimesPerUser
     *
     * @return PromoCode
     */
    public function setMaximumNumberOfAllowedTimesPerUser($maximumNumberOfAllowedTimesPerUser)
    {
        $this->maximumNumberOfAllowedTimesPerUser = $maximumNumberOfAllowedTimesPerUser;

        return $this;
    }

    /**
     * Get maximumNumberOfAllowedTimesPerUser
     *
     * @return integer
     */
    public function getMaximumNumberOfAllowedTimesPerUser()
    {
        return $this->maximumNumberOfAllowedTimesPerUser;
    }

    /**
     * Set maximumNumberOfUsersAllowedToUse
     *
     * @param integer $maximumNumberOfUsersAllowedToUse
     *
     * @return PromoCode
     */
    public function setMaximumNumberOfUsersAllowedToUse($maximumNumberOfUsersAllowedToUse)
    {
        $this->maximumNumberOfUsersAllowedToUse = $maximumNumberOfUsersAllowedToUse;

        return $this;
    }

    /**
     * Get maximumNumberOfUsersAllowedToUse
     *
     * @return integer
     */
    public function getMaximumNumberOfUsersAllowedToUse()
    {
        return $this->maximumNumberOfUsersAllowedToUse;
    }

    /**
     * Set maximumAllowedTimesForAllUsers
     *
     * @param integer $maximumAllowedTimesForAllUsers
     *
     * @return PromoCode
     */
    public function setMaximumAllowedTimesForAllUsers($maximumAllowedTimesForAllUsers)
    {
        $this->maximumAllowedTimesForAllUsers = $maximumAllowedTimesForAllUsers;

        return $this;
    }

    /**
     * Get maximumAllowedTimesForAllUsers
     *
     * @return integer
     */
    public function getMaximumAllowedTimesForAllUsers()
    {
        return $this->maximumAllowedTimesForAllUsers;
    }

    /**
     * Set numberOfUsedByUsers
     *
     * @param integer $numberOfUsedByUsers
     *
     * @return PromoCode
     */
    public function setNumberOfUsedByUsers($numberOfUsedByUsers)
    {
        $this->numberOfUsedByUsers = $numberOfUsedByUsers;

        return $this;
    }

    /**
     * Get numberOfUsedByUsers
     *
     * @return integer
     */
    public function getNumberOfUsedByUsers()
    {
        return $this->numberOfUsedByUsers;
    }

    /**
     * Set numberOfUsedTimes
     *
     * @param integer $numberOfUsedTimes
     *
     * @return PromoCode
     */
    public function setNumberOfUsedTimes($numberOfUsedTimes)
    {
        $this->numberOfUsedTimes = $numberOfUsedTimes;

        return $this;
    }

    /**
     * Get numberOfUsedTimes
     *
     * @return integer
     */
    public function getNumberOfUsedTimes()
    {
        return $this->numberOfUsedTimes;
    }

    /**
     * Set usageTotalAmount
     *
     * @param string $usageTotalAmount
     *
     * @return PromoCode
     */
    public function setUsageTotalAmount($usageTotalAmount)
    {
        $this->usageTotalAmount = $usageTotalAmount;

        return $this;
    }

    /**
     * Get usageTotalAmount
     *
     * @return string
     */
    public function getUsageTotalAmount()
    {
        return $this->usageTotalAmount;
    }

    /**
     * Set sendToAllUsers
     *
     * @param boolean $sendToAllUsers
     *
     * @return PromoCode
     */
    public function setSendToAllUsers($sendToAllUsers)
    {
        $this->sendToAllUsers = $sendToAllUsers;

        return $this;
    }

    /**
     * Get sendToAllUsers
     *
     * @return boolean
     */
    public function getSendToAllUsers()
    {
        return $this->sendToAllUsers;
    }

    /* start of logic functions should be moved to a service if possible */

    /**
     * @return array
     */
    public static function getTypes()
    {
        return array(
            PromoCode::PROMOCODE_TYPE_FIXED_VALUE => PromoCode::PROMOCODE_TYPE_FIXED_VALUE,
            PromoCode::PROMOCODE_TYPE_PERCENTAGE => PromoCode::PROMOCODE_TYPE_PERCENTAGE
        );
    }

    /**
     * @return integer
     */
    public function getRemainingUsageTimes()
    {
        return $this->maximumAllowedTimesForAllUsers ? $this->maximumAllowedTimesForAllUsers - $this->numberOfUsedTimes : '∞';
    }

    /**
     * @return integer
     */
    public function getMaximumUsageTimesString()
    {
        return $this->maximumAllowedTimesForAllUsers ? $this->maximumAllowedTimesForAllUsers : '∞';
    }

    /**
     * @return boolean
     */
    public function isUsable()
    {
        return !(!$this->enabled || $this->getExpired());
    }

    /**
     * @return boolean
     */
    public function getExpired()
    {
        return (($this->expiryTime) && ($this->expiryTime < new \DateTime())) || ($this->maximumAllowedTimesForAllUsers && ($this->maximumAllowedTimesForAllUsers === $this->numberOfUsedTimes)) || ($this->maximumNumberOfUsersAllowedToUse && ($this->maximumNumberOfUsersAllowedToUse === $this->numberOfUsedByUsers));
    }

    /**
     * @return boolean
     */
    public function getAllowMultiUseForSingleUser()
    {
        return $this->maximumNumberOfAllowedTimesPerUser > 1 ? true : false;
    }

    /**
     * @param boolean $allowMultiUseForSingleUser
     *
     * @return PromoCode
     */
    public function setAllowMultiUseForSingleUser($allowMultiUseForSingleUser)
    {
        if (!$allowMultiUseForSingleUser) {
            $this->maximumAllowedTimesForAllUsers = 1;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGroupSequence()
    {
        // Default validation group "Default" is PromoCode Because we use group sequence provider
        $groups = array('PromoCode');
        if ($this->id) {
            $groups[] = 'edit';
        } else {
            $groups[] = 'create';
        }
        if (PromoCode::PROMOCODE_TYPE_FIXED_VALUE === $this->type) {
            $groups[] = 'fixed-value';
        }
        if (PromoCode::PROMOCODE_TYPE_PERCENTAGE === $this->type) {
            $groups[] = 'percentage';
        }
        return $groups;
    }

    /**
     * @return string
     */
    public function getDiscountAmountString()
    {
        return $this->getDiscountAmount() . ' ' . ($this->getType() === PromoCode::PROMOCODE_TYPE_PERCENTAGE ? '%' : 'SR');
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

}
