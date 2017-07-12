<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Ibtikar\ShareEconomyPayFortBundle\Entity\PfPaymentMethodHolderInterface;
use Ibtikar\ShareEconomyPayFortBundle\Entity\PfPaymentMethodHolderTrait;
use Ibtikar\GoogleServicesBundle\Entity\DeviceUserInterface;
use Ibtikar\TaniaModelBundle\Entity\BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="entityClass", type="string")
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser implements PfPaymentMethodHolderInterface, DeviceUserInterface
{
    public static $paymentMethods = array('cash' => 'cash', 'balance' => 'balance', 'credit' => 'credit');

    use PfPaymentMethodHolderTrait;

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
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"signup", "edit"})
     */
    protected $city;

    /**
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"backend_admin_create", "backend_admin_edit"})
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Role")
     */
    private $role;

    /**
     * @var string $neighborhood
     *
     * @ORM\Column(name="neighborhood", type="string", length=100, nullable=true)
     * @Assert\Length(min = 4, max = 15, groups={"signup", "edit"}, maxMessage="neighborhood_length_not_valid", minMessage="neighborhood_length_not_valid")
     */
    protected $neighborhood;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=400, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"signup", "edit"})
     * @Assert\Length(min = 4, max = 300, groups={"signup", "edit"}, maxMessage="address_length_not_valid", minMessage="address_length_not_valid")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", precision=10, scale=7, options={"default": 0}, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"signup", "edit"})
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal", precision=10, scale=7, options={"default": 0}, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"signup", "edit"})
     */
    private $latitude;
    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order",mappedBy="user")
     */
    protected $orders;

    public function __sleep() {
        $classVars = get_object_vars($this);
        // unset all object proxies not the collections
        unset($classVars['city']);
        unset($classVars['country']);
        unset($classVars['file']);
        return array_keys($classVars);
    }

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

    /**
     * Set role
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Role $role
     *
     * @return User
     */
    public function setRole(\Ibtikar\TaniaModelBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        if ($this->role) {
            return array_merge($this->role->getPermissions(), parent::getRoles());
        }
        return parent::getRoles();
    }

    /**
     * Set neighborhood
     *
     * @param string $neighborhood
     *
     * @return User
     */
    public function setNeighborhood($neighborhood)
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    /**
     * Get neighborhood
     *
     * @return string
     */
    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
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
     * @return User
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
     * @return User
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

    public function getUserAddresses()
    {
        $addresses[] = array('title' => '', 'address' => $this->address, 'longitude' => $this->longitude, 'latitude' => $this->latitude);

        foreach($this->addresses as $address)
            $addresses[] = array('title' => $address->getTitle(), 'address' => $address->getAddress(), 'longitude' => $address->getLongitude(), 'latitude' => $address->getLatitude());

        return $addresses;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="payment_method", type="string", length=20, nullable = true)
     */
    private $paymentMethod;


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

}
