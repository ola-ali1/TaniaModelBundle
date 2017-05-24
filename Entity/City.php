<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="city")
 * @ORM\Entity()
 */
class City
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
     * @ORM\Column(name="name_ar", type="string")
     */
    private $nameAr;

    /**
     * @ORM\Column(name="name_en", type="string")
     */
    private $nameEn;

    /**
     * @ORM\Column(name="city_polygon", type="string")
     */
    private $cityPolygon;

    /**
     * @ORM\Column(name="latitude", type="string")
     */
    private $latitude;

    /**
     * @ORM\Column(name="longitude", type="string")
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Country", inversedBy="cities")
     */
    protected $country;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User",mappedBy="city")
     */
    protected $users;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Price",mappedBy="city")
     */
    protected $prices;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order",mappedBy="city")
     */
    protected $orders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prices = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameAr
     *
     * @param string $nameAr
     *
     * @return User
     */
    public function setNameAr($nameAr)
    {
        $this->nameAr = $nameAr;

        return $this;
    }

    /**
     * Get nameAr
     *
     * @return string
     */
    public function getNameAr()
    {
        return $this->nameAr;
    }

    /**
     * Set nameEn
     *
     * @param string $nameEn
     *
     * @return User
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Set cityPolygon
     *
     * @param string $cityPolygon
     *
     * @return User
     */
    public function setCityPolygon($cityPolygon)
    {
        $this->cityPolygon = $cityPolygon;

        return $this;
    }

    /**
     * Get cityPolygon
     *
     * @return string
     */
    public function getCityPolygon()
    {
        return $this->cityPolygon;
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
     * Add user
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $user
     *
     * @return Country
     */
    public function addUser(\Ibtikar\TaniaModelBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $user
     */
    public function removeUser(\Ibtikar\TaniaModelBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add price
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Price $price
     *
     * @return Price
     */
    public function addPrice(\Ibtikar\TaniaModelBundle\Entity\Price $price)
    {
        $this->prices[] = $price;

        return $this;
    }

    /**
     * Remove price
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Price $price
     */
    public function removePrice(\Ibtikar\TaniaModelBundle\Entity\Price $price)
    {
        $this->prices->removeElement($price);
    }

    /**
     * Get prices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrices()
    {
        return $this->prices;
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
