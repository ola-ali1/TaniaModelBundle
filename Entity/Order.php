<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Ibtikar\ShareEconomyPayFortBundle\Entity\PfTransactionInvoiceInterface;
use Doctrine\ORM\Mapping as ORM;
use Ibtikar\TaniaModelBundle\Entity\Offer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Ibtikar\ShareEconomyPayFortBundle\Entity\PfTransaction;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Ibtikar\TaniaModelBundle\Entity\UserAddress;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="entityClass", type="string")
 * @ORM\Table(name="`order`")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\OrderRepository")
 */
class Order implements PfTransactionInvoiceInterface
{
    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    const CASH = 'CASH';
    const SADAD = 'SADAD';
    const BALANCE = 'BALANCE';
    const CREDIT = 'CREDIT';
    const POINTS = 'POINTS';
    const MADA = 'MADA';

    const TYPE_MASAJED = 'MASAJED';
    const TYPE_USER = 'USER';

    public static $addressTypes = array(
        self::TYPE_MASAJED => 'Masjed',
        self::TYPE_USER => 'User',
    );

    public static $paymentMethodList = array(
        self::CASH => 'Cash',
        self::SADAD => 'SADAD',
        self::CREDIT => 'Online With Card Id',
        self::BALANCE => 'Balance',
        self::POINTS => 'Points',
        self::MADA => 'MADA CARD',
    );

    public static $paymentMethodNebrasListV2 = array(
        'Cash' => '1',
        'Credit' => '2',
        'Coupon' => '3',
        'Annual' => '4',
        'Credit Card' => '5',
        'SADAD' => '6',
        'BALANCE' => '7',
        'TC' => '8',
        'CASH' => '1',
        'CREDIT' => '2',
        'COUPON' => '3',
        'ANNUAL' => '4',
        'MADA' => '9',
    );

    public static $statuses = array(
        'new' => 'new',
        'verified' => 'verified',
        'delivering' => 'delivering',
        'delivered' => 'delivered',
        'returned' => 'returned',
        'cancelled' => 'cancelled',
        'closed' => 'closed',
        'transaction-pending' => 'transaction-pending',
        'confirmed' => 'confirmed'
    );

    public static $statusCategories = array(
        'current'   => array('new', 'verified', 'delivering', 'returned'),
        'past'      => array('delivered', 'closed', 'transaction-pending', 'cancelled', 'confirmed')
    );

    public static $disallowDeletePaymentStatuses = array('new', 'verified', 'delivering', 'transaction-pending');
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User")
     */
    private $assignedBy;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User", inversedBy="orders")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Driver", inversedBy="driverOrders")
     */
    protected $driver;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\CityArea", inversedBy="orders")
     */
    protected $cityArea;

    /**
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Van")
     */
    protected $van;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\City", inversedBy="orders")
     */
    protected $city;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Shift", inversedBy="orders")
     */
    protected $shift;

    /**
     * @var string
     *
     * @ORM\Column(name="`shift_from`", type="datetime")
     */
    private $shiftFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="`shift_to`", type="datetime")
     */
    private $shiftTo;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderItem",mappedBy="order")
     */
    protected $orderItems;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderOffer",mappedBy="order")
     */
    protected $orderOffers;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderPackage",mappedBy="order")
     */
    protected $orderPackages;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Offer", inversedBy="orders")
     */
    protected $offer;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderStatusHistory",mappedBy="order", cascade={"persist", "remove"})
     */
    protected $orderStatuses;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Ibtikar\ShareEconomyPayFortBundle\Entity\PfTransaction", mappedBy="invoice")
     */
    private $pfTransactions;

    /**
     * @var bool
     *
     * @ORM\Column(name="pfPayed", type="boolean", options={"default": false})
     */
    private $pfPayed = false;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_method", type="string")
     */
    private $paymentMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="second_payment_method", type="string")
     */

    private $secondPaymentMethod;
    /**
     * @var text
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

    /**
     * @var text
     *
     * @ORM\Column(name="close_reason", type="text", nullable=true)
     */
    private $closeReason;

    /**
     * @var string
     *
     * @ORM\Column(name="return_reason", type="string", length=190, nullable=true)
     */
    private $returnReason;


    /**
     * @var string
     *
     * @ORM\Column(name="cancel_reason", type="string", length=190, nullable=true)
     */
    private $cancelReason;

    /**
     * @var string
     *
     * @ORM\Column(name="cancel_date", type="datetime", nullable=true)
     */
    private $cancelDate;

    /**
     * @var string
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="skip_reason", type="string", length=190, nullable=true)
     */
    private $skipReason;

    /**
     * @var \DateTime $requiredDeliveryDate
     *
     * @ORM\Column(name="requiredDeliveryDate", type="date", nullable=true)
     */
    private $requiredDeliveryDate;

    /**
     * @var text
     *
     * @ORM\Column(name="receiving_date", type="text", nullable=true)
     */
    private $receivingDate;

    /**
     * @var Ibtikar\ShareEconomyPayFortBundle\Entity\PfPaymentMethod
     *
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @ORM\ManyToOne(targetEntity="Ibtikar\ShareEconomyPayFortBundle\Entity\PfPaymentMethod")
     */
    private $creditCard;

    /**
     * @var string
     *
     * @ORM\Column(name="fort_id", type="string", length=190, nullable=true)
     *
     */
    private $fortId;

    /**
     * @var string
     *
     * @ORM\Column(name="card_number", type="string", length=20, nullable=true)
     *
     */
    private $cardNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="expiry_date", type="string", length=10, nullable=true)
     *
     */
    private $expiryDate;

    /**
     * @var string
     *
     * @ORM\Column(name="merchant_reference", type="string", length=50, nullable=true)
     *
     */
    private $merchantReference;

    /**
     * @var string
     *
     * @ORM\Column(name="token_name", type="string", length=190, nullable=true)
     *
     */
    private $tokenName;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_option", type="string", length=50, nullable=true)
     */
    private $paymentOption;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_value", type="string", length=50, nullable=true)
     */
    private $paymentValue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_default", type="boolean", options={"default": true})
     */
    private $isDefault = false;

    /**
     * @var string
     *
     * @ORM\Column(name="amountDue", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $amountDue;

    /**
     * @var string
     *
     * @ORM\Column(name="first_payment_price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $firstPaymentPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="second_payment_price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $secondPaymentPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, options={"default": 0})
     * @Assert\Type(type="numeric")
     */
    protected $price;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_fees", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $taxFees;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=190, nullable=true)
     */
    private $source;

    /**
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\PromoCode", inversedBy="orders")
     */
    protected $promoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_name", type="string", length=20, nullable=true)
     */
    private $promoCodeName;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_method", type="string", length=11, nullable=true)
     */
    private $promoCodeMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code_value", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $promoCodeValue;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_phone", type="string", length=190, nullable=true)
     */
    protected $customerPhone;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=2, nullable=true, options={"default": 0})
     */
     protected $isAutoAssigned;

    /**
     * @param int $isAutoAssigned
     * @return Order
     */
     public function setIsAutoAssigned($isAutoAssigned)
     {
         $this->isAutoAssigned = $isAutoAssigned;
         return $this;
     }

    /**
     * @return int
     */
    public function isAutoAssigned()
    {
        return $this->isAutoAssigned;
    }

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\UserAddress")
     */
    protected $userAddress;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_nana_synced", type="boolean",  options={"default": 0}, nullable=true)
     */
    protected $isNanaSynced;

    /**
     * @var array
     *
     * @ORM\Column(name="nana_sync_data", type="array", nullable=true)
     */
    private $nanaSyncData;

    /**
     * Set nanaSyncData
     *
     * @param array $nanaSyncData
     *
     * @return array
     */
    public function setNanaSyncData($nanaSyncData)
    {
        $this->nanaSyncData = $nanaSyncData;

        return $this;
    }

    /**
     * Get nanaSyncData
     *
     * @return array
     */
    public function getNanaSyncData()
    {
        return $this->nanaSyncData;
    }

    /**
     * Set isNanaSynced
     *
     * @param boolean $isNanaSynced
     *
     * @return boolean
     */
    public function setIsNanaSynced($isNanaSynced)
    {
        $this->isNanaSynced = $isNanaSynced;

        return $this;
    }

    /**
     * Get $isNanaSynced
     *
     * @return boolean
     */
    public function getIsNanaSynced()
    {
        return $this->isNanaSynced;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="address_verified", type="integer", length=1, nullable=true)
     */
    protected $addressVerified;

    /**
     * @var int
     *
     * @ORM\Column(name="closed_by", type="integer", length=1, nullable=true)
     */
    protected $closedBy;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=1, nullable=true)
     */
    protected $createdBy;


    /**
     * @var int
     *
     * @ORM\Column(name="closed_by_fullName", type="string", length=100, nullable=true)
     */
    protected $closedByFullName;

    /**
     * Set promoCode
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\PromoCode $promoCode
     *
     * @return PromoCode
     */
    public function setPromoCode(\Ibtikar\TaniaModelBundle\Entity\PromoCode $promoCode = null)
    {
        if ($promoCode) {
            $this->setPromoCodeMethod($promoCode->getType());
            $this->setPromoCodeName($promoCode->getCode());
            $this->setPromoCodeValue($promoCode->getDiscountAmount());
        } else {
            $this->setPromoCodeMethod(null);
            $this->setPromoCodeName(null);
            $this->setPromoCodeValue(null);
        }

        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * Get promoCode
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\PromoCode
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * @return string
     */
    public function getPromoCodeName()
    {
        return $this->promoCodeName;
    }

    /**
     * @param string $promoCodeName
     */
    public function setPromoCodeName($promoCodeName)
    {
        $this->promoCodeName = $promoCodeName;
    }

    /**
     * @return string
     */
    public function getPromoCodeValue()
    {
        return $this->promoCodeValue;
    }

    /**
     * @param string $promoCodeValue
     */
    public function setPromoCodeValue($promoCodeValue)
    {
        $this->promoCodeValue = $promoCodeValue;
    }

    /**
     * @return string
     */
    public function getPromoCodeMethod()
    {
        return $this->promoCodeMethod;
    }

    /**
     * @param string $promoCodeMethod
     */
    public function setPromoCodeMethod($promoCodeMethod)
    {
        $this->promoCodeMethod = $promoCodeMethod;
    }

    /**
     * Set taxFees
     *
     * @param string $taxFees
     *
     * @return Order
     */
    public function setTaxFees($taxFees)
    {
        $this->taxFees = $taxFees;

        return $this;
    }

    /**
     * Get taxFees
     *
     * @return string
     */
    public function getTaxFees()
    {
        return $this->taxFees;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Balance
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
     * @var string
     *
     * @ORM\Column(name="rate", type="decimal", precision=4, scale=2, nullable=true,options={"comment":"value set by user for rating order"})
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"rate"})
     * @Assert\Regex(
     *     pattern="/^[1-5]$/",
     *     match=true,
     *     message = "invalid_rate",
     *     groups = {"rate"}
     * )
     */
    private $rate;

    /**
     * @var string
     *
     * @ORM\Column(name="old_rate", type="decimal", precision=4, scale=2, nullable=true,options={"default": 0, "comment":"the old rating if user rerated"})
     * @Assert\Regex(
     *     pattern="/^[1-5]$/",
     *     match=true,
     *     message = "invalid_rate",
     *     groups = {"rate"}
     * )
     */
    private $oldRate;

    /**
     * @var string
     *
     * @ORM\Column(name="rate_comment", type="string", length=190, nullable=true,options={"comment":"value set by user for rating order"})
     * @Assert\Length(min = 3, max = 140, groups={"rate"}, maxMessage="comment_length_not_valid", minMessage="comment_length_not_valid", groups={"rate"})
     */
    private $rateComment;

    /**
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderRatingTag", mappedBy="order")
     */
    private $orderRatingTags;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=190)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_verification_code", type="string", length=20, nullable=true)
     */
    private $destinationVerificationCode;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_verification_code_counter", type="integer", length=20, nullable=true, options={"default": 0})
     */
    private $destinationVerificationCodeCounter = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_verification_code_date", type="string", length=10, nullable=true)
     *
     */
    private $destinationVerificationCodeDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     * @Assert\Length(min = 4, max = 20, maxMessage="addressTitle_length_not_valid", minMessage="addressTitle_length_not_valid")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=400, nullable=true)
     * @Assert\Length(min = 4, max = 300, maxMessage="address_length_not_valid", minMessage="address_length_not_valid")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="float", options={"default": 0}, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="float", options={"default": 0}, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="starting_longitude", type="float", options={"default": 0}, nullable=true)
     */
    private $startingLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="starting_latitude", type="float", options={"default": 0}, nullable=true)
     */
    private $startingLatitude;

    /**
     * @ORM\Column(name="van_number", type="string", nullable=true)
     */
    private $vanNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100, nullable=true)
     *
     * @Assert\Length(min = 4, max = 12, groups={"username"}, maxMessage="username_length_not_valid", minMessage="username_length_not_valid")
     */
    private $driverUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_username", type="string", length=100, nullable=true)
     */
    private $customerUsername;


    /**
     * @var string
     *
     * @ORM\Column(name="driver_phone", type="string", length=100, nullable=true)
     *
     */
    private $driverPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_fullName", type="string", length=190, nullable=true)
     *
     */
    protected $driverFullName;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_fullNameAr", type="string", length=190, nullable=true)
     *
     */
    protected $driverFullNameAr;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by_fullName", type="string", length=190, nullable=true)
     *
     */
    protected $createdByFullName;

    /**
     * @var string
     *
     * @ORM\Column(name="city_area_name_en", type="string", length=15, nullable=true)
     *
     */
    protected $cityAreaNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="city_area_name_ar", type="string", length=15, nullable=true)
     *
     */
    protected $cityAreaNameAr;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_image", type="string", length=300, nullable=true)
     *
     */
    protected $driverImage;

    /**
     * @var string
     *
     * @ORM\Column(name="driver_rate", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $driverRate;

    /**
     * @var string
     *
     * @ORM\Column(name="isSynced", type="boolean",  options={"default": 0}, nullable=true)
     */
    protected $isSynced;

    /**
     * @var string
     *
     * @ORM\Column(name="address_type", type="string", length=30, options={"default": "USER"})
     */
    private $addressType = self::TYPE_USER;


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
     * @var string $successImage
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $successImage;

    /**
     * a temp variable for storing the old image name to delete the old image after the update
     * @var string $temp
     */
    protected $temp;

    /**
     * @var UploadedFile $file
     */
    protected $file;

    /**
     * @var integer
     * @ORM\Column(type="integer", length=2, nullable=true, options={"default": 0})
     */
    protected $isAutoAssigned;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orderStatuses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pfTransactions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->orderOffers = new \Doctrine\Common\Collections\ArrayCollection();


        // NEW-ISPL START
        $this->offerBuyItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offerGetItems = new \Doctrine\Common\Collections\ArrayCollection();
        // NEW-ISPL END
        $this->setStatus(self::$statuses['new']);
    }

    /**
     * needed to disable the doctrine proxy __get as it trigger notice error
     * @param string $name
     */
    public function __get($name)
    {
        throw new \Exception("Variable $name was not found");
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
     * Set assignedBy
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $assignedBy
     *
     * @return User
     */
    public function setAssignedBy(\Ibtikar\TaniaModelBundle\Entity\User $assignedBy = null)
    {
        $this->assignedBy = $assignedBy;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\User
     */
    public function getAssignedBy()
    {
        return $this->assignedBy;
    }

    /**
     * Set user
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $user
     *
     * @return User
     */
    public function setUser(\Ibtikar\TaniaModelBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add orderItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderItem $orderItem
     *
     * @return OrderItem
     */
    public function addOrderItem(\Ibtikar\TaniaModelBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }

    /**
     * Remove orderItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderItem $orderItem
     */
    public function removeOrderItem(\Ibtikar\TaniaModelBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems->removeElement($orderItem);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderItems()
    {
        return $this->orderItems;
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
     * Set shift
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Shift $shift
     *
     * @return Shift
     */
    public function setShift(\Ibtikar\TaniaModelBundle\Entity\Shift $shift = null)
    {
        $this->shift = $shift;

        return $this;
    }

    /**
     * Get shift
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Shift
     */
    public function getShift()
    {
        return $this->shift;
    }

    /**
     * Set offer
     *
     * @param Offer $offer
     *
     * @return Offer
     */
    public function setOffer(Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Set creditCard
     *
     * @param \Ibtikar\ShareEconomyPayFortBundle\Entity\PfPaymentMethod $creditCard
     *
     * @return Order
     */
    public function setCreditCard(\Ibtikar\ShareEconomyPayFortBundle\Entity\PfPaymentMethod $creditCard = null)
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    /**
     * Get creditCard
     *
     * @return \Ibtikar\ShareEconomyPayFortBundle\Entity\PfPaymentMethod
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * Set pfPayed
     *
     * @param boolean $pfPayed
     *
     * @return Order
     */
    public function setPfPayed($pfPayed)
    {
        $this->pfPayed = $pfPayed;

        return $this;
    }

    /**
     * Get pfPayed
     *
     * @return boolean
     */
    public function getPfPayed()
    {
        return $this->pfPayed;
    }


    /**
     * Add pfTransaction
     *
     * @param \Ibtikar\ShareEconomyPayFortBundle\Entity\PfTransaction $pfTransaction
     *
     * @return Order
     */
    public function addPfTransaction(\Ibtikar\ShareEconomyPayFortBundle\Entity\PfTransaction $pfTransaction)
    {
        $this->pfTransactions[] = $pfTransaction;

        return $this;
    }

    /**
     * Remove pfTransaction
     *
     * @param \Ibtikar\ShareEconomyPayFortBundle\Entity\PfTransaction $pfTransaction
     */
    public function removePfTransaction(\Ibtikar\ShareEconomyPayFortBundle\Entity\PfTransaction $pfTransaction)
    {
        $this->pfTransactions->removeElement($pfTransaction);
    }

    /**
     * Get pfTransactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPfTransactions()
    {
        return $this->pfTransactions;
    }

    /**
     * @return Ibtikar\ShareEconomyPayFortBundle\Entity\PfPaymentMethod
     */
    public function getPfPaymentMethod()
    {
        return $this->creditCard;
    }

    /**
     * Set paymentMethod
     *
     * @param string $paymentMethod
     *
     * @return Order
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set secondPaymentMethod
     *
     * @param string $secondPaymentMethod
     *
     * @return Order
     */
    public function setSecondPaymentMethod($secondPaymentMethod)
    {
        $this->secondPaymentMethod = $secondPaymentMethod;

        return $this;
    }

    /**
     * Get secondPaymentMethod
     *
     * @return string
     */
    public function getSecondPaymentMethod()
    {
        return $this->secondPaymentMethod;
    }

    /**
     * Set firstPaymentPrice
     *
     * @param string $firstPaymentPrice
     *
     * @return Order
     */
    public function setFirstPaymentPrice($firstPaymentPrice)
    {
        $this->firstPaymentPrice = $firstPaymentPrice;
        return $this;
    }

    /**
     * Get firstPaymentPrice
     *
     * @return string
     */
    public function getFirstPaymentPrice()
    {
        return $this->firstPaymentPrice;
    }

    /**
     * Set secondPaymentPrice
     *
     * @param string $secondPaymentPrice
     *
     * @return Order
     */
    public function setSecondPaymentPrice($secondPaymentPrice)
    {
        $this->secondPaymentPrice = $secondPaymentPrice;
        return $this;
    }

    /**
     * Get secondPaymentPrice
     *
     * @return string
     */
    public function getSecondPaymentPrice()
    {
        return $this->secondPaymentPrice;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Order
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set receivingDate
     *
     * @param string $receivingDate
     *
     * @return Order
     */
    public function setReceivingDate($receivingDate)
    {
        $this->receivingDate = $receivingDate;
        if ($receivingDate) {
            try {
                $requiredDeliveryDate = new \DateTime('@' . $receivingDate);
                $requiredDeliveryDate->setTimezone(new \DateTimeZone(date_default_timezone_get()));
                $this->setRequiredDeliveryDate($requiredDeliveryDate);
            } catch (\Exception $ex) {
                $this->setRequiredDeliveryDate(null);
            }
        } else {
            $this->setRequiredDeliveryDate(null);
        }

        return $this;
    }

    /**
     * Get receivingDate
     *
     * @return string
     */
    public function getReceivingDate()
    {
        return $this->receivingDate;
    }

    /**
     * Set amountDue
     *
     * @param string $amountDue
     *
     * @return RequestOrder
     */
    public function setAmountDue($amountDue)
    {
        $this->amountDue = $amountDue;

        return $this;
    }

    /**
     * Get amountDue
     *
     * @return string
     */
    public function getAmountDue()
    {
        return $this->amountDue;
    }

    /**
     * Set rate
     *
     * @param string $rate
     *
     * @return Order
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate + 0;
    }

    /**
     * Set oldRate
     *
     * @param string $oldRate
     *
     * @return Order
     */
    public function setOldRate($oldRate)
    {
        $this->oldRate = $oldRate;

        return $this;
    }

    /**
     * Get oldRate
     *
     * @return string
     */
    public function getOldRate()
    {
        return $this->oldRate + 0;
    }

    /**
     * Set rateComment
     *
     * @param string $rateComment
     *
     * @return RequestOrder
     */
    public function setRateComment($rateComment)
    {
        $this->rateComment = $rateComment;

        return $this;
    }

    /**
     * Get rateComment
     *
     * @return string
     */
    public function getRateComment()
    {
        return $this->rateComment;
    }

    /**
     * Set driver
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Driver $driver
     *
     * @return Driver
     */
    public function setDriver(\Ibtikar\TaniaModelBundle\Entity\Driver $driver = null)
    {
        $this->driver = $driver;
        if ($driver) {
            $this->setDriverFullName($driver->getFullName());
            $this->setDriverFullNameAr($driver->getFullNameAr());
            if ($driver->getImage()) {
                $this->setDriverImage($driver->getWebPath());
            }
            $this->setDriverPhone($driver->getPhone());
            $this->setDriverRate($driver->getDriverRate());
            $this->setDriverUsername($driver->getUsername());
            foreach ($driver->getVanDrivers() as $vanDriver) {
                $this->setVan($vanDriver->getVan());
            }
        } else {
            $this->setDriverFullName(null);
            $this->setDriverFullNameAr(null);
            $this->setDriverImage(null);
            $this->setDriverPhone(null);
            $this->setDriverRate(0);
            $this->setDriverUsername(null);
            $this->van = null;
        }

        return $this;
    }

    /**
     * Get driver
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set status and log status history
     *
     * @param string $status
     *
     * @return Order
     */
    public function setStatusAndLogStatusHistory($status, $createdBy = null)
    {
        $orderStatus = new OrderStatusHistory();
        $orderStatus->setStatus($status);
        $orderStatus->setOrder($this);
        $orderStatus->setActionDoneBy($this->getDriver());
        $orderStatus->setCreatedBy($createdBy);
        $this->addOrderStatus($orderStatus);
        $this->status = $status;
        return $this;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Order
     */
    public function setStatus($status, $createdBy = null)
    {
        if ($status != $this->status) {
            $orderStatus = new OrderStatusHistory();
            $orderStatus->setStatus($status);
            $orderStatus->setOrder($this);
            $orderStatus->setActionDoneBy($this->getDriver());
            $orderStatus->setCreatedBy($createdBy);
            $this->addOrderStatus($orderStatus);
        }
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set van
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Van $van
     *
     * @return Van
     */
    public function setVan(\Ibtikar\TaniaModelBundle\Entity\Van $van = null)
    {
        $this->van = $van;
        $this->setVanNumber($van->getVanNumber());

        return $this;
    }

    /**
     * Get driver
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Van
     */
    public function getVan()
    {
        return $this->van;
    }

    /**
     * Get Van Type
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\VanType
     */
    public function getVanType()
    {
        return $this->getVan() && $this->getVan()->getType() ? $this->getVan()->getType() : null;
    }

    public function getStatuses()
    {
        return array_flip(self::$statuses);
    }

    public function getUserName()
    {
        if ($this->user) {
            return $this->user->getFullName();
        }

        if ($userName = $this->getCustomerUsername()) {
            return $userName;
        }

        return '';
    }

    public function getUserPhone()
    {
        if ($this->user) {
            return $this->user->getPhone();
        }

        if ($userPhone = $this->getCustomerPhone()) {
            return $userPhone;
        }

        return '';
    }

    public function getUserBalance()
    {
        if ($this->user) {
            return $this->user->getBalance();
        }

        return '';
    }

    /**
     * Set closeReason
     *
     * @param string $closeReason
     *
     * @return Order
     */
    public function setCloseReason($closeReason)
    {
        $this->closeReason = $closeReason;

        return $this;
    }

    /**
     * Get closeReason
     *
     * @return string
     */
    public function getCloseReason()
    {
        return $this->closeReason;
    }

    /**
     * Set destinationVerificationCode
     *
     * @param string $destinationVerificationCode
     *
     * @return RequestOrder
     */
    public function setDestinationVerificationCode($destinationVerificationCode)
    {
        $this->destinationVerificationCode = $destinationVerificationCode;

        return $this;
    }

    /**
     * Get destinationVerificationCode
     *
     * @return string
     */
    public function getDestinationVerificationCode()
    {
        return $this->destinationVerificationCode;
    }

    /**
     * Set shiftFrom
     *
     * @param string $shiftFrom
     *
     * @return ShiftFrom
     */
    public function setShiftFrom($shiftFrom)
    {
        $this->shiftFrom = $shiftFrom;

        return $this;
    }

    /**
     * Get shiftFrom
     *
     * @return string
     */
    public function getShiftFrom()
    {
        return $this->shiftFrom;
    }

    /**
     * Set shiftTo
     *
     * @param string $shiftTo
     *
     * @return ShiftTo
     */
    public function setShiftTo($shiftTo)
    {
        $this->shiftTo = $shiftTo;

        return $this;
    }

    /**
     * Get shiftTo
     *
     * @return string
     */
    public function getShiftTo()
    {
        return $this->shiftTo;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return UserAddress
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return UserAddress
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return UserAddress
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set startingLongitude
     *
     * @param string $startingLongitude
     *
     * @return UserAddress
     */
    public function setStartingLongitude($startingLongitude)
    {
        $this->startingLongitude = $startingLongitude;

        return $this;
    }

    /**
     * Get startingLongitude
     *
     * @return string
     */
    public function getStartingLongitude()
    {
        return $this->startingLongitude;
    }

    /**
     * Set startingLatitude
     *
     * @param string $startingLatitude
     *
     * @return UserAddress
     */
    public function setStartingLatitude($startingLatitude)
    {
        $this->startingLatitude = $startingLatitude;

        return $this;
    }

    /**
     * Get startingLatitude
     *
     * @return string
     */
    public function getStartingLatitude()
    {
        return $this->startingLatitude;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return UserAddress
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

    public function getDriverUsername()
    {
        return $this->driverUsername;
    }

    public function setDriverUsername($driverUsername)
    {
        $this->driverUsername = $driverUsername;

        return $this;
    }

    /**
     * Set vanNumber
     *
     * @param string $vanNumber
     *
     * @return Van
     */
    public function setVanNumber($vanNumber)
    {
        $this->vanNumber = $vanNumber;

        return $this;
    }

    /**
     * Get vanNumber
     *
     * @return string
     */
    public function getVanNumber()
    {
        return $this->vanNumber;
    }

    /**
     * Set cardNumber
     *
     * @param string $cardNumber
     *
     * @return Order
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get cardNumber
     *
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set expiryDate
     *
     * @param string $expiryDate
     *
     * @return Order
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * Get expiryDate
     *
     * @return string
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * Set merchantReference
     *
     * @param string $merchantReference
     *
     * @return Order
     */
    public function setMerchantReference($merchantReference)
    {
        $this->merchantReference = $merchantReference;

        return $this;
    }

    /**
     * Get merchantReference
     *
     * @return string
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * Set tokenName
     *
     * @param string $tokenName
     *
     * @return Order
     */
    public function setTokenName($tokenName)
    {
        $this->tokenName = $tokenName;

        return $this;
    }

    /**
     * Get tokenName
     *
     * @return string
     */
    public function getTokenName()
    {
        return $this->tokenName;
    }

    /**
     * Set paymentOption
     *
     * @param string $paymentOption
     *
     * @return Order
     */
    public function setPaymentOption($paymentOption)
    {
        $this->paymentOption = $paymentOption;

        return $this;
    }

    /**
     * Get paymentOption
     *
     * @return string
     */
    public function getPaymentOption()
    {
        return $this->paymentOption;
    }

    /**
     * Set paymentValue
     *
     * @param string $paymentValue
     *
     * @return Order
     */
    public function setPaymentValue($paymentValue)
    {
        $this->paymentValue = $paymentValue;

        return $this;
    }

    /**
     * Get paymentValue
     *
     * @return string
     */
    public function getPaymentValue()
    {
        return $this->paymentValue;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     *
     * @return Order
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set fortId
     *
     * @param string $fortId
     *
     * @return Order
     */
    public function setFortId($fortId)
    {
        $this->fortId = $fortId;

        return $this;
    }

    /**
     * Get fortId
     *
     * @return string
     */
    public function getFortId()
    {
        return $this->fortId;
    }

    /**
     * Set driverPhone
     *
     * @param string $driverPhone
     *
     * @return Order
     */
    public function setDriverPhone($driverPhone)
    {
        $this->driverPhone = $driverPhone;

        return $this;
    }

    /**
     * Get driverPhone
     *
     * @return string
     */
    public function getDriverPhone()
    {
        return $this->driverPhone;
    }

    /**
     * Set driverFullName
     *
     * @param string $driverFullName
     *
     * @return Order
     */
    public function setDriverFullName($driverFullName)
    {
        $this->driverFullName = $driverFullName;

        return $this;
    }

    /**
     * Get driverFullName
     *
     * @return string
     */
    public function getDriverFullName()
    {
        return $this->driverFullName;
    }

    /**
     * Set driverFullNameAr
     *
     * @param string $driverFullNameAr
     *
     * @return Order
     */
    public function setDriverFullNameAr($driverFullNameAr)
    {
        $this->driverFullNameAr = $driverFullNameAr;

        return $this;
    }

    /**
     * Set createdByFullName
     *
     * @param string $createdByFullName
     *
     * @return Order
     */
    public function setCreatedByFullName($createdByFullName)
    {
        $this->createdByFullName = $createdByFullName;

        return $this;
    }

    /**
     * Get driverFullNameAr
     *
     * @return string
     */
    public function getDriverFullNameAr()
    {
        return $this->driverFullNameAr;
    }

    /**
     * Get createdByFullName
     *
     * @return string
     */
    public function getCreatedByFullName()
    {
        return $this->createdByFullName;
    }

    /**
     * Set driverImage
     *
     * @param string $driverImage
     *
     * @return Order
     */
    public function setDriverImage($driverImage)
    {
        $this->driverImage = $driverImage;

        return $this;
    }

    /**
     * Get driverImage
     *
     * @return string
     */
    public function getDriverImage()
    {
        return $this->driverImage;
    }

    /**
     * Set driverRate
     *
     * @param string $driverRate
     *
     * @return Order
     */
    public function setDriverRate($driverRate)
    {
        $this->driverRate = $driverRate;

        return $this;
    }

    /**
     * Get driverRate
     *
     * @return string
     */
    public function getDriverRate()
    {
        return $this->driverRate;
    }

    /**
     * Set cityArea
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\CityArea $cityArea
     *
     * @return Order
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
     * Set destinationVerificationCodeCounter
     *
     * @param integer $destinationVerificationCodeCounter
     *
     * @return Order
     */
    public function setDestinationVerificationCodeCounter($destinationVerificationCodeCounter)
    {
        $this->destinationVerificationCodeCounter = $destinationVerificationCodeCounter;

        return $this;
    }

    /**
     * Get destinationVerificationCodeCounter
     *
     * @return integer
     */
    public function getDestinationVerificationCodeCounter()
    {
        return $this->destinationVerificationCodeCounter;
    }

    /**
     * Set destinationVerificationCodeDate
     *
     * @param string $destinationVerificationCodeDate
     *
     * @return Order
     */
    public function setDestinationVerificationCodeDate($destinationVerificationCodeDate)
    {
        $this->destinationVerificationCodeDate = $destinationVerificationCodeDate;

        return $this;
    }

    /**
     * Get destinationVerificationCodeDate
     *
     * @return string
     */
    public function getDestinationVerificationCodeDate()
    {
        return $this->destinationVerificationCodeDate;
    }

    /**
     * Set returnReason
     *
     * @param string $returnReason
     *
     * @return Order
     */
    public function setReturnReason($returnReason)
    {
        $this->returnReason = $returnReason;

        return $this;
    }

    /**
     * Get returnReason
     *
     * @return string
     */
    public function getReturnReason()
    {
        return $this->returnReason;
    }

    /**
     * Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @return null|integer
     */
    public function getCityAreaId()
    {
        if ($this->getCityArea()) {
            return $this->getCityArea()->getId();
        }
    }

    /**
     * @return boolean
     */
    public function isOrderAssignableToOfflineDrivers()
    {
        if ($this->getShiftFrom() && $this->getShiftTo() && $this->getRequiredDeliveryDate()) {
            $orderShiftStartTime = new \DateTime($this->getShiftFrom()->format('H:i:s'));
            $orderShiftEndTime = new \DateTime($this->getShiftTo()->format('H:i:s'));
            $currentTime = new \DateTime();
            if ($this->getRequiredDeliveryDate()->format('d') === $currentTime->format('d') && $this->getRequiredDeliveryDate()->format('m') === $currentTime->format('m') && $currentTime >= $orderShiftStartTime && $currentTime <= $orderShiftEndTime) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return null|string
     */
    public function getDeliveryDate()
    {
        if ($this->requiredDeliveryDate) {
            return $this->requiredDeliveryDate->format('d/m/Y');
        }
    }

    /**
     * @return null|string
     */
    public function getShiftFromString()
    {
        if ($this->shiftFrom) {
            return $this->shiftFrom->format('H:i');
        }
    }

    /**
     * @return null|string
     */
    public function getShiftToString()
    {
        if ($this->shiftTo) {
            return $this->shiftTo->format('H:i');
        }
    }

    /**
     * @return null|string
     */
    public function getShiftNameAr()
    {
        if ($this->shift) {
            return $this->shift->getShiftAr();
        }
    }

    /**
     * @return null|string
     */
    public function getShiftNameEn()
    {
        if ($this->shift) {
            return $this->shift->getShift();
        }
    }

    /**
     * @return integer
     */
    public function getOrdersCount()
    {
        if ($this->user) {
            return $this->user->getOrdersCount();
        }
    }

    /**
     * check if it is possible to create new transaction for this invoice or not
     * @return boolean
     */
    public function canCreateNewTransaction()
    {
        $return = true;

        if ($this->getPfTransactions()) {
            foreach ($this->getPfTransactions() as $transaction) {
                if ($transaction->getCurrentStatus() != PfTransaction::STATUS_FAIL) {
                    $return = false;
                    break;
                }
            }
        }

        return $return;
    }

    /**
     * Set applicationLanguage
     *
     * @param string $isSynced
     *
     * @return User
     */
    public function setIsSynced($isSynced)
    {
        $this->isSynced = $isSynced;

        return $this;
    }

    /**
     * Get $isSynced
     *
     * @return string
     */
    public function getIsSynced()
    {
        return $this->isSynced;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersist($event)
    {
        if ($event instanceof  PreUpdateEventArgs) {
            if ($event->hasChangedField('isAsynced') == true) {
                $this->isSynced= false;
            }
        } else {
            $this->isSynced= false;
        }
    }


    /**
     * Set returnReason
     *
     * @param string $returnReason
     *
     * @return Order
     */
    public function setSkipReason($skipReason)
    {
        $this->skipReason = $skipReason;

        return $this;
    }

    /**
     * Get returnReason
     *
     * @return string
     */
    public function getSkipReason()
    {
        return $this->skipReason;
    }

    /**
     * Set cancelReason
     *
     * @param string $cancelReason
     *
     * @return Order
     */
    public function setCancelReason($cancelReason)
    {
        $this->cancelReason = $cancelReason;

        return $this;
    }

    /**
     * Get cancelReason
     *
     * @return string
     */
    public function getCancelReason()
    {
        return $this->cancelReason;
    }

    /**
     * Set cancelDate
     *
     * @param string $cancelDate
     *
     * @return Order
     */
    public function setCancelDate($cancelDate)
    {
        $this->cancelDate = $cancelDate;

        return $this;
    }

    /**
     * Get cancelDate
     *
     * @return string
     */
    public function getCancelDate()
    {
        return $this->cancelDate;
    }

    public function getBalanceRequestStatuses()
    {
        $statuses = self::$statuses;
        unset($statuses['cancelled']);
        unset($statuses['transaction-pending']);
        return array_flip($statuses);
    }

    /**
     * Add orderStatus
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderStatusHistory $orderStatus
     *
     * @return OrderStatusHistory
     */
    public function addOrderStatus(\Ibtikar\TaniaModelBundle\Entity\OrderStatusHistory $orderStatus)
    {
        $this->orderStatuses[] = $orderStatus;

        return $this;
    }

    /**
     * Remove orderStatus
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderStatusHistory $orderStatus
     */
    public function removeOrderStatus(\Ibtikar\TaniaModelBundle\Entity\OrderStatusHistory $orderStatus)
    {
        $this->orderStatuses->removeElement($orderStatus);
    }

    /**
     * Get $orderStatuses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderStatuses()
    {
        return $this->orderStatuses;
    }

    public function getPaymentMethods()
    {
        return self::$paymentMethodList;
    }

    public function getRateValues()
    {
        return ['1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5];
    }

    /**
     * Get cityNameAr
     *
     * @return string
     */
    public function getCityNameAr()
    {
        return $this->city ? $this->city->getNameAr(): '';
    }

    /**
     * Get cityNameEn
     *
     * @return string
     */
    public function getCityNameEn()
    {
        return $this->city ? $this->city->getNameEn(): '';
    }


    /**
     * Set cityAreaNameEn
     *
     * @param string $cityAreaNameEn
     *
     * @return Order
     */
    public function setCityAreaNameEn($cityAreaNameEn)
    {
        $this->cityAreaNameEn = $cityAreaNameEn;

        return $this;
    }

    /**
     * Get cityAreaNameEn
     *
     * @return string
     */
    public function getCityAreaNameEn()
    {
        return $this->cityAreaNameEn;
    }

    /**
     * Set cityAreaNameAr
     *
     * @param string $cityAreaNameAr
     *
     * @return Order
     */
    public function setCityAreaNameAr($cityAreaNameAr)
    {
        $this->cityAreaNameAr = $cityAreaNameAr;

        return $this;
    }

    /**
     * Get cityAreaNameAr
     *
     * @return string
     */
    public function getCityAreaNameAr()
    {
        return $this->cityAreaNameAr;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Order
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime|null
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @return string
     */
    public function getItemsNamesAndQuantities()
    {
        $itemsString = '';
        foreach ($this->orderItems as $orderItem) {
            if (strlen($itemsString) !== 0) {
                $itemsString .= '<br/>';
            }
            $itemsString .= '(' . $orderItem->getCount() . ') '. $orderItem->getItem()->getNameEn();
        }
        return $itemsString;
    }

    /**
     * @return string
     */
    public function getItemsNamesAndQuantitiesEn()
    {
        return $this->getItemsNamesAndQuantities();
    }

    /**
     * @return string
     */
    public function getItemsNamesAndQuantitiesAr()
    {
        $itemsString = '';
        foreach ($this->orderItems as $orderItem) {
            if (strlen($itemsString) !== 0) {
                $itemsString .= '<br/>';
            }
            $itemsString .= '(' . $orderItem->getCount() . ') '. $orderItem->getItem()->getName();
        }
        return $itemsString;
    }

    //NEW-ISPL START
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
        // echo 'shailesh';exit;
        $itemsString = '';
        foreach ($this->offerBuyItems as $item) {
            // echo '-----------------';
            // print_r($item);exit;
            if (strlen($itemsString) !== 0) {
                $itemsString .= '<br/>';
            }
            $itemsString .= '(' . $item->getCount() . ') '. $item->getNameEn();
        }
        return $itemsString;
    }

    /* public function getOfferBuyItemsNamesAndQuantitiesEn1()
     {
         return $this->getOfferBuyItemsNamesAndQuantities();
     }*/
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

    //NEW-ISPL END

    /**
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @return Integer
     */
    public function getItemsCount()
    {
        $itemsCount = 0;
        foreach ($this->orderItems as $orderItem) {
            $itemsCount += $orderItem->getCount();
        }
        return $itemsCount;
    }

    /**
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @return string
     */
    public function getEndDateString()
    {
        $endDateString = '';
        if ($this->endDate) {
            $endDateString = $this->endDate->format('d/m/Y');
        }
        return $endDateString;
    }

    /**
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @return string
     */
    public function getTotalSpentTimeAr()
    {
        $time = '';
        if ($this->endDate && $this->createdAt) {
            $timeInterval = $this->endDate->diff($this->createdAt);
            $minuteString = 'دقيقة';
            $hourString = 'ساعة';
            $dayString = 'يوم';
            $time = $timeInterval->format("%a $dayString, %H $hourString, %I $minuteString");
        }
        return $time;
    }

    /**
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @return string
     */
    public function getTotalSpentTimeEn()
    {
        $time = '';
        if ($this->endDate && $this->createdAt) {
            $timeInterval = $this->endDate->diff($this->createdAt);
            $minuteString = 'minute';
            $hourString = 'hour';
            $dayString = 'day';
            $time = $timeInterval->format("%a $dayString, %H $hourString, %I $minuteString");
        }
        return $time;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Order
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return array
     */
    public function getSources()
    {
        return array('android' => 'android',
            'ios'              => 'ios',
            'cc-agent'         => 'cc-agent',
            'driver-app'       => 'driver-app',
            'Landing-Page'     => 'Landing-Page',
            'nana'             => 'nana',
            'tania-system'     => 'tania-system',
            'tania-website'    => 'tania-website',
            'tania-order-now'  => 'tania-order-now',
            'oxidane'          => 'oxidane',
            'erwaa'          => 'erwaa',
        );
    }

    /**
     * Set requiredDeliveryDate
     *
     * @param \DateTime $requiredDeliveryDate
     *
     * @return Order
     */
    public function setRequiredDeliveryDate($requiredDeliveryDate)
    {
        $this->requiredDeliveryDate = $requiredDeliveryDate;

        return $this;
    }

    /**
     * Get requiredDeliveryDate
     *
     * @return \DateTime
     */
    public function getRequiredDeliveryDate()
    {
        return $this->requiredDeliveryDate;
    }

    /**
     * Set customer_username
     *
     * @param string $customerUsername
     *
     * @return Order
     */
    public function setCustomerUsername($customerUsername)
    {
        $this->customerUsername = $customerUsername;

        return $this;
    }

    /**
     * Get customer_username
     *
     * @return string
     */
    public function getCustomerUsername()
    {
        return $this->customerUsername;
    }

    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     *
     * @return User
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * Get customerPhone
     *
     * @return string
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * Get addressType
     *
     * @return string
     */
    public function getAddressType()
    {
        return $this->addressType;
    }

    /**
     * Set addressType
     *
     * @param string $addressType
     *
     * @return Order
     */
    public function setAddressType($AddressType)
    {
        $this->addressType = $AddressType;
        return $this;
    }

    /**
     * Get userAddress
     *
     * @return UserAddress
     */
    public function getUserAddress()
    {
        return $this->userAddress;
    }

    /**
     * Set userAddress
     *
     * @param UserAddress $userAddress
     *
     * @return Order
     */
    public function setUserAddress(UserAddress $userAddress = null)
    {
        $this->userAddress = $userAddress;
        return $this;
    }

    public function getAddressTypes()
    {
        return self::$addressTypes;
    }


    public function getPromoCodeText()
    {
        return $this->getPromoCode()->getCode();
    }
    public function getPromoCodeType()
    {
        return $this->getPromoCode()->getType();
    }
    public function getDiscountAmountString()
    {
        return $this->getPromoCode()->getDiscountAmountString();
    }

    /**
     * Add orderOffer
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderOffer $orderOffer
     *
     * @return Order
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

    /**
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderRatingTag $orderRatingTag
     * @return Order
     */
    public function setOrderRatingTags($orderRatingTags)
    {
        $this->orderRatingTags = $orderRatingTags;
        return $this;
    }

    /**
     * @return \Ibtikar\TaniaModelBundle\Entity\OrderRatingTag
     */
    public function getOrderRatingTags()
    {
        return $this->orderRatingTags;
    }


    public function getOrderReturnedBy()
    {
        if ($this->getStatus() == self::$statuses['returned'] && $this->getOrderStatuses()->last()) {
            if ($driver = $this->getOrderStatuses()->last()->getActionDoneBy()) {
                return $driver->getFullNameAr();
            }
        }

        return "";
    }

    // NEW-ISPL START on 31/12/2018
    /*   *
      * @return string
      */
    public function getOfferBuyItemsNamesEn()
    {
        $itemsString = '';
        //dump($this->orderOffers);exit;
        foreach ($this->orderOffers as $orderOffer) {
            $OrderOfferBuyItems = $orderOffer->getOrderOfferBuyItems();
            // dump($OrderOfferBuyItems);exit;
            foreach ($OrderOfferBuyItems as $OrderOfferBuyItem) {
                if (strlen($itemsString) !== 0) {
                    $itemsString .= '<br/>';
                }
                $itemsString .= $orderOffer->getTitleEn().'&nbsp;&nbsp;&nbsp;<br/>'.'('.$OrderOfferBuyItem->getCount().') '.$OrderOfferBuyItem->getNameEn() .'&nbsp;&nbsp;&nbsp;<br/>'.'('.$orderOffer->getCount().') '.$OrderOfferBuyItem->getNameEn();
            }
        }
        return $itemsString;

        // foreach ($this->orderOffers as $orderOffer) {
        // if (strlen($itemsString) !== 0) {
        // $itemsString .= '<br/>';
        // }
        // $itemsString .= $orderOffer->getTitleEn();
        // }
        // return $itemsString;
    }
    /**
     * @return string
     */
    public function getOfferBuyItemsNamesAr()
    {
        // echo 'Call Arbic';exit;
        $itemsString = '';
        foreach ($this->orderOffers as $orderOffer) {
            $OrderOfferBuyItems = $orderOffer->getOrderOfferBuyItems();
            // dump($OrderOfferBuyItems);exit;
            foreach ($OrderOfferBuyItems as $OrderOfferBuyItem) {
                if (strlen($itemsString) !== 0) {
                    $itemsString .= '<br/>';
                }
                $itemsString .= $orderOffer->getTitle().'&nbsp;&nbsp;&nbsp;<br/>'.'('.$OrderOfferBuyItem->getCount().') '.$OrderOfferBuyItem->getName() .'&nbsp;&nbsp;&nbsp;<br/>'.'('.$orderOffer->getCount().') '.$OrderOfferBuyItem->getName();
            }
        }
        return $itemsString;
    }
    // NEW-ISPL END on 31/12/2018

    // NEW-ISPL START on 03/02/2019
    /**
     * Set addressVerified
     *
     * @param integer $addressVerified
     *
     * @return Order
     */
    public function setAddressVerified($addressVerified)
    {
        $this->addressVerified = $addressVerified;

        return $this;
    }

    /**
     * Get addressVerified
     *
     * @return string
     */
    public function getAddressVerified()
    {
        return $this->addressVerified;
    }
    // NEW-ISPL END on 03/02/2019

    // NEW-ISPL START on 12/02/2019
    /**
     * Set closedByFullName
     *
     * @param string $closedByFullName
     *
     * @return Order
     */
    public function setClosedByFullName($closedByFullName)
    {
        $this->closedByFullName = $closedByFullName;

        return $this;
    }

    /**
     * Get closedByFullName
     *
     * @return string
     */
    public function getClosedByFullName()
    {
        return $this->closedByFullName;
    }
    /**
     * Set createdBy
     *
     * @param integer $createdBy
     *
     * @return Order
     */
    public function setClosedBy($closedBy)
    {
        $this->closedBy = $closedBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer
     */
    public function getClosedBy()
    {
        return $this->closedBy;
    }
    // NEW-ISPL END on 12/02/2019

    // NEW-ISPL START on 16/02/2019
    /**
     * @var int
     *
     * @ORM\Column(name="address_verified_cron_count", type="integer", length=10, nullable=true)
     */
    protected $addressVerifiedCronCount;
    /**
     * Set addressVerifiedCronCount
     *
     * @param integer $addressVerifiedCronCount
     *
     * @return Order
     */
    public function setAddressVerifiedCronCount($addressVerifiedCronCount)
    {
        $this->addressVerifiedCronCount = $addressVerifiedCronCount;

        return $this;
    }

    /**
     * Get addressVerifiedCronCount
     *
     * @return integer
     */
    public function getAddressVerifiedCronCount()
    {
        return $this->addressVerifiedCronCount;
    }
    // NEW-ISPL END on 16/02/2019

    // NEW-ISPL START on 17/02/2019

    /**
     * @var string
     *
     * @ORM\Column(name="app_version",type="string", nullable=true)
     */
    protected $appVersion;

    /**
     * @var
     *
     * @ORM\Column(name="device_information",type="text", nullable=true)
     */
    protected $deviceInformation;

    /**
     * @return int
     */
    public function getAppVersion()
    {
        return $this->appVersion;
    }

    /**
     * @param int $appVersion
     */
    public function setAppVersion($appVersion)
    {
        $this->appVersion = $appVersion;
    }

    /**
     * @param mixed $deviceInformation
     * @return Order
     */
    public function setDeviceInformation($deviceInformation)
    {
        if (preg_match("/<[^<]+>/", $deviceInformation, $m) == 0) {
            $parts = explode(",", $deviceInformation);
            $deviceInformation = implode('</br>', $parts);
        }
        $this->deviceInformation = $deviceInformation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeviceInformation()
    {
        return $this->deviceInformation;
    }

    /**
     * @return int
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * Set file
     *
     * @param UploadedFile $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;
        //check if we have an old image
        if ($this->successImage) {
            //store the old name to delete on the update
            $this->temp = $this->successImage;
            $this->successImage = null;
        } else {
            $this->successImage = 'initial';
        }

        return $this;
    }

    /**
     * Get file
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * this function is used to delete the current successImage
     * the deleting of the current object will also delete the successImage and you do not need to call this function
     * if you call this function before you remove the object the successImage will not be removed
     */
    public function removeImage()
    {
        //check if we have an old successImage
        if ($this->successImage) {
            //store the old name to delete on the update
            $this->temp = $this->successImage;
            //delete the current successImage
            $this->successImage = null;
        }
    }

    /**
     * create the the directory if not found
     * @param string $directoryPath
     * @throws \Exception if the directory can not be created
     */
    private function createDirectory($directoryPath)
    {
        if (!@is_dir($directoryPath)) {
            $oldumask = umask(0);
            $success = @mkdir($directoryPath, 0755, true);
            umask($oldumask);
            if (!$success) {
                throw new \Exception("Can not create the directory $directoryPath");
            }
        }
    }

    public function upload()
    {
        if (null !== $this->file && (null === $this->successImage || 'initial' === $this->successImage)) {
            //get the image extension
            $extension = $this->file->guessExtension();
            //generate a random image name
            $img = uniqid();
            //get the image upload directory
            $uploadDir = $this->getUploadRootDir();
            if (!is_dir($uploadDir)) {
                $this->createDirectory($uploadDir);
            }

            $fileName = $img.".".$extension;
            while (@file_exists("$uploadDir/$fileName")) {
                //try to find a new unique name
                $img = uniqid();
            }

            $fileName = $img.".".$extension;

            $this->successImage = $fileName;

            $this->setSuccessImage($fileName);
            // you must throw an exception here if the file cannot be moved
            // so that the entity is not persisted to the database
            // which the UploadedFile move() method does
            $this->file->move($this->getUploadRootDir(), $this->successImage);

            $this->file = null;
        }

        if ($this->temp) {
            //try to delete the old image
//            @unlink($this->getUploadRootDir() . '/' . $this->temp);
            //clear the temp image
            $this->temp = null;
        }
    }

    /**
     * @return string the path of successImage starting of root
     */
    public function getAbsolutePath()
    {
        return $this->getUploadRootDir() . '/' . $this->successImage;
    }

    /**
     * @return string the relative path of image starting from web directory
     */
    public function getWebPath()
    {
        return null === $this->successImage ? null : $this->getUploadDir() . '/' . $this->successImage;
    }

    /**
     * @return string the path of upload directory starting of root
     */
    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * @return string the document upload directory path starting from web folder
     */
    private function getUploadDir()
    {
        return 'uploads/orderSuccess';
    }

    /**
     * @return string
     */
    public function getSuccessImage()
    {
        return $this->successImage;
    }

    /**
     * @param string $successImage
     */
    public function setSuccessImage($successImage)
    {
        $this->successImage = $successImage;
    }

    /**
     * @param int $isAutoAssigned
     * @return Order
     */
    public function setIsAutoAssigned($isAutoAssigned)
    {
        $this->isAutoAssigned = $isAutoAssigned;
        return $this;
    }

    /**
     * @return int
     */
    public function isAutoAssigned()
    {
        return $this->isAutoAssigned;
    }
}
