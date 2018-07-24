<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromoCodeCity
 *
 * @ORM\Table(name="promo_code_city")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\PromoCodeCityRepository")
 */
class PromoCodeCity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\PromoCode", inversedBy="promoCodeCities")
     */
    private $promoCode;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\City", inversedBy="promoCodeCities")
     */
    private $city;

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
     * Set promoCode
     *
     * @param PromoCode $promoCode
     *
     * @return PromoCodeCity
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * Get promoCode
     *
     * @return PromoCode
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set city
     *
     * @param City $city
     *
     * @return PromoCodeCity
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }
}

