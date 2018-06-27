<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CityArea
 *
 * @UniqueEntity(fields={"nameAr"}, groups={"create", "edit"})
 * @UniqueEntity(fields={"nameEn"}, groups={"create", "edit"})
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Table(name="city_area")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\CityAreaRepository")
 */
class CityArea
{

    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

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
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"create", "edit"})
     * @Assert\Length(min = 3, max = 15, groups={"create", "edit"})
     * @ORM\Column(name="nameAr", type="string", length=15)
     */
    private $nameAr;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"create", "edit"})
     * @Assert\Length(min = 3, max = 15, groups={"create", "edit"})
     * @ORM\Column(name="nameEn", type="string", length=15)
     */
    private $nameEn;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"create", "edit"})
     * @ORM\Column(name="polygon", type="text")
     */
    private $polygon;

    /**
     * @var \Ibtikar\TaniaModelBundle\Entity\City
     *
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\City")
     */
    private $city;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order",mappedBy="cityArea")
     */
    protected $orders;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\DriverCityArea",mappedBy="cityArea", cascade={"persist"})
     */
    protected $driverCityAreas;

    /**
     * @ORM\Column(name="order_count", type="integer", options={"default": 0})
     */
    private $driverCount = 0;

    /**
     * @var \DateTime $deletedAt
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->driverCityAreas = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "$this->nameAr";
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
     * @return CityArea
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
     * @return CityArea
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
     * Set city
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\City $city
     *
     * @return CityArea
     */
    public function setCity(\Ibtikar\TaniaModelBundle\Entity\City $city)
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
     * Set polygon
     *
     * @param string $polygon
     *
     * @return CityArea
     */
    public function setPolygon($polygon)
    {
        $this->polygon = $polygon;

        return $this;
    }

    /**
     * Get polygon
     *
     * @return string
     */
    public function getPolygon()
    {
        return $this->polygon;
    }

    /**
     * Add driverCityArea
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\DriverCityArea $driverCityArea
     *
     * @return Van
     */
    public function addDriverCityArea(\Ibtikar\TaniaModelBundle\Entity\DriverCityArea $driverCityArea)
    {
        $this->driverCityAreas[] = $driverCityArea;

        $driverCityArea->setDriver($this);

        return $this;
    }

    /**
     * Remove driverCityArea
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\DriverCityArea $driverCityArea
     */
    public function removeDriverCityArea(\Ibtikar\TaniaModelBundle\Entity\DriverCityArea $driverCityArea)
    {
        $this->driverCityAreas->removeElement($driverCityArea);
    }

    /**
     * Get driverCityAreas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDriverCityAreas()
    {
        return $this->driverCityAreas;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return this
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


    /**
     * Add order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     *
     * @return CityArea
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
     * Set driverCount
     *
     * @param string $driverCount
     *
     * @return driverCount
     */
    public function setDriverCount($driverCount)
    {
        $this->driverCount = $driverCount;

        return $this;
    }

    /**
     * Get driverCount
     *
     * @return string
     */
    public function getDriverCount()
    {
        return $this->driverCount;
    }

    public function decrementDriverCount()
    {
        if($this->driverCount > 0)
            $this->driverCount = $this->driverCount - 1;
    }


    public function incrementDriverCount()
    {
        $this->driverCount = $this->driverCount + 1;
    }
}
