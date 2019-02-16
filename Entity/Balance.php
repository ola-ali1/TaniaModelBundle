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
     * @ORM\Column(name="points", type="integer")
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     */
    private $points;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=190)
     * @Assert\NotBlank
     * @Assert\Length(max = 100)
     */
    private $name;

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
     * Set name
     *
     * @param string $name
     *
     * @return Balance
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
