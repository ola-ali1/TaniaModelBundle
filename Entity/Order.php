<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Ibtikar\ShareEconomyPayFortBundle\Entity\PfTransactionInvoiceInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="`order`")
 * @ORM\Entity()
 */
class Order implements PfTransactionInvoiceInterface
{
    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    public static $paymentMethodList = array(
        '1' => 'Cash',
        '2' => 'SADAD',
        '3' => 'Online With Card Id',
        '4' => 'Balance'
    );

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User", inversedBy="orders")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\City", inversedBy="orders")
     */
    protected $city;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Shift", inversedBy="orders")
     */
    protected $shift;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderItem",mappedBy="order")
     */
    protected $orderItems;

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
     * @var text
     *
     * @ORM\Column(name="note", type="text")
     */
    private $note;

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
     * @ORM\Column(name="amountDue", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $amountDue;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pfTransactions = new \Doctrine\Common\Collections\ArrayCollection();
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
}
