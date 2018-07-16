<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="shift")
 * @ORM\Entity()
 */
class Shift
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
     * @var string
     *
     * @ORM\Column(name="shift", type="string")
     */
    private $shift;

    /**
     * @var string
     *
     * @ORM\Column(name="shift_ar", type="string")
     */
    private $shiftAr;

    /**
     * @var string
     *
     * @ORM\Column(name="`from`", type="datetime")
     */
    private $from;

    /**
     * @var string
     *
     * @ORM\Column(name="`to`", type="datetime")
     */
    private $to;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order",mappedBy="shift")
     */
    protected $orders;
    

    /**
     * @var integer
     *
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     * @ORM\Column(name="maximumAllowedOrdersPerDay", type="integer", nullable=true)
     */
    private $maximumAllowedOrdersPerDay;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="is_deleted", type="integer",nullable=true, options={"default" : 0})
     */
    private $isDeleted;
    
    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\ShiftDays")
     */
    protected $shiftDay;

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
    
    public function setId($id)
    {
        return $this->id=$id;
    }

    /**
     * Set shift
     *
     * @param string $shift
     *
     * @return Shift
     */
    public function setShift($shift)
    {
        $this->shift = $shift;

        return $this;
    }

    /**
     * Get shift
     *
     * @return string
     */
    public function getShift()
    {
        return $this->shift;
    }

    /**
     * Set shiftAr
     *
     * @param string $shiftAr
     *
     * @return Shift
     */
    public function setShiftAr($shiftAr)
    {
        $this->shiftAr = $shiftAr;

        return $this;
    }

    /**
     * Get shiftAr
     *
     * @return string
     */
    public function getShiftAr()
    {
        return $this->shiftAr;
    }

    /**
     * Set from
     *
     * @param string $from
     *
     * @return From
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param string $to
     *
     * @return To
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Add order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     *
     * @return Order
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

    /**
     * @return integer
     */
    public function getMaximumAllowedOrdersPerDay()
    {
        return $this->maximumAllowedOrdersPerDay;
    }

    /**
     * @param integer $maximumAllowedOrdersPerDay
     * @return Shift
     */
    public function setMaximumAllowedOrdersPerDay($maximumAllowedOrdersPerDay)
    {
        $this->maximumAllowedOrdersPerDay = $maximumAllowedOrdersPerDay;
        return $this;
    }
    
    /**
     * @return integer
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }
    
    /**
     * @param integer $isDeleted
     * @return Shift
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
        return $this;
    }
    
    /**
     * Set shiftDay
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\ShiftDays $shiftDay
     *
     * @return Shift
     */
    public function setShiftDay($shiftDay)
    {
        $this->shiftDay = $shiftDay;
        
        return $this;
    }
    
    /**
     * Get shiftDay
     *
     * @return \Ibtikar\TaniaModelBUndle\Entity\ShiftDays
     */
    public function getShiftDay()
    {
        return $this->shiftDay;
    }

}
