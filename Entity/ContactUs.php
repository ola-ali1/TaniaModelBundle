<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContactUs
 *
 * @ORM\Table(name="contact_us")})
 * @ORM\Entity
 */
class ContactUs
{
    
    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    public static $contactTypes = array(
        'driver-contact' => 'driver-contact',
        'suggestion' => 'suggestion',
        'complain' => 'complain'
    );

    use \Ibtikar\ShareEconomyToolsBundle\Entity\TrackableTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=190, nullable=true)
     *
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 4, max = 50, maxMessage="title_length_not_valid", minMessage="title_length_not_valid")
     */
    private $title;

 /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=500, nullable=true)
     *
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 10, max = 300, maxMessage="description_length_not_valid", minMessage="description_length_not_valid")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="text", length=20, nullable=false)
     *
     * @Assert\NotBlank(message="fill_mandatory_field")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order")
     */
    protected $order;

    /**
     * Set order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     *
     * @return ContactUs
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Ibtikar\TaniaModelBUndle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User")
     */
    private $user;

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
     * Set title
     *
     * @param string $title
     *
     * @return ContactUs
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
     * Set description
     *
     * @param string $description
     *
     * @return ContactUs
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ContactUs
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
     * Set user
     *
     * @param \Ibtikar\ShareEconomyUMSBundle\Entity\BaseUser $user
     *
     * @return ContactUs
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ibtikar\ShareEconomyUMSBundle\Entity\BaseUser
     */
    public function getUser()
    {
        return $this->user;
    }

    public function getTypeName()
    {
        return $this->getType() ? $this->getType()->getTitleEn() : "---";
    }

    public function getUserName()
    {
        if($this->user)
            return $this->getUser()->getFullName();

        return;
    }

    public function getUserEmail()
    {
        if($this->user)
            return $this->getUser()->getEmail();

        return;
    }

    public function getUserPhone()
    {
        if($this->user)
            return $this->getUser()->getPhone();

        return;
    }

    public function getOrderId()
    {
        if($this->order)
            return $this->getOrder()->getId();

        return;
    }
}