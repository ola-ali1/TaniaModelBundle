<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * CityArea
 *
 * @UniqueEntity(fields={"nameAr"}, groups={"create", "edit"})
 * @UniqueEntity(fields={"nameEn"}, groups={"create", "edit"})
 *
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
     * @ORM\Column(name="nameAr", type="string", length=15, unique=true)
     */
    private $nameAr;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="fill_mandatory_field", groups={"create", "edit"})
     * @Assert\Length(min = 3, max = 15, groups={"create", "edit"})
     * @ORM\Column(name="nameEn", type="string", length=15, unique=true)
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
}
