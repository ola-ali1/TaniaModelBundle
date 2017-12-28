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
     * @ORM\Column(name="points", type="decimal", precision=10, scale=2, options={"default": 0})
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
     * Set balanceName
     *
     * @param string $balanceName
     *
     * @return BalanceRequest
     */
    public function setBalanceName($balanceName)
    {
        $this->balanceName = $balanceName;

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
