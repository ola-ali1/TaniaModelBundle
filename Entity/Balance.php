<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * BareedoBalance
 *
 * @ORM\Table(name="balance")
 * @ORM\Entity()
 */
class Balance
{

    use \Ibtikar\ShareEconomyToolsBundle\Entity\TrackableTrait;

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
     * @ORM\Column(name="balance", type="decimal", precision=10, scale=2, options={"default": 0})
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     */
    private $balance;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, options={"default": 0})
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     */
    private $price;

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
     * Set balance
     *
     * @param string $balance
     *
     * @return Balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
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
}
