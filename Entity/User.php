<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Ibtikar\TaniaModelBundle\Entity\BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="entityClass", type="string")
 * @ORM\Table(name="user")
 * @ORM\Entity()
 */
class User extends BaseUser
{


    public static $roleList = array(
        'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
        'ROLE_ADMIN' => 'ROLE_ADMIN',
        'ROLE_FINANCE' => 'ROLE_FINANCE',
        'ROLE_SUPPORT' => 'ROLE_SUPPORT'
    );

    /**
     * @Assert\Regex("/ar|en/")
     * @ORM\Column(name="application_language", type="string", length=2, options={"default": "ar"})
     */
    private $applicationLanguage = 'ar';

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Country", inversedBy="users")
     */
    protected $country;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\City", inversedBy="users")
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"signup"})
     */
    protected $city;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order",mappedBy="user")
     */
    protected $orders;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set applicationLanguage
     *
     * @param string $applicationLanguage
     *
     * @return User
     */
    public function setApplicationLanguage($applicationLanguage)
    {
        $this->applicationLanguage = $applicationLanguage;

        return $this;
    }

    /**
     * Get applicationLanguage
     *
     * @return string
     */
    public function getApplicationLanguage()
    {
        return $this->applicationLanguage;
    }

    /**
     * Set country
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Country $country
     *
     * @return Country
     */
    public function setCountry(\Ibtikar\TaniaModelBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
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
}
