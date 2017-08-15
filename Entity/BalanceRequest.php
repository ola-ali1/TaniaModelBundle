<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints AS Assert;
use Ibtikar\TaniaModelBundle\Entity\Order;

/**
 *
 * @ORM\Table(name="`order`")
 * @ORM\Entity()
 */
class BalanceRequest extends Order
{

    /**
     * @var string
     *
     * @ORM\Column(name="points", type="integer")
     * @Assert\Type(type="numeric")
     */
    protected $points;

    /**
     * @var string
     *
     * @ORM\Column(name="balance_name", type="string", length=190)
     */
    private $balanceName;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, options={"default": 0})
     * @Assert\Type(type="numeric")
     */
    protected $price;

    /**
     * Set points
     *
     * @param string $points
     *
     * @return Balance
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return string
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Balance
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Set balanceName
     *
     * @param string $balanceName
     *
     * @return BalanceRequest
     */
    public function setBalanceName($balanceName)
    {
        $this->name = $balanceName;

        return $this;
    }

    /**
     * Get balanceName
     *
     * @return string
     */
    public function getBalanceName()
    {
        return $this->balanceName;
    }
}
