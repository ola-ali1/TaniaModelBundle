<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="order_status_history")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\OrderStatusHistoryRepository")
 */
class OrderStatusHistory
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
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order", inversedBy="orderStatuses")
     */
    protected $order;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=190)
     */
    private $status;


    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User")
     */
    private $actionDoneBy;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User")
     */
    private $createdBy = null;

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
     * Set status
     *
     * @param string $status
     *
     * @return OrderStatusHistory
     */
    public function setStatus($status)
    {
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
     * Set actionDoneBy
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $actionDoneBy
     *
     * @return User
     */
    public function setActionDoneBy(\Ibtikar\TaniaModelBundle\Entity\User $actionDoneBy = null)
    {
        $this->actionDoneBy = $actionDoneBy;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\User
     */
    public function getActionDoneBy()
    {
        return $this->actionDoneBy;
    }

    /**
     * Set createdBy
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $createdBy
     *
     * @return User
     */
    public function setCreatedBy(\Ibtikar\TaniaModelBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }    
    
}
