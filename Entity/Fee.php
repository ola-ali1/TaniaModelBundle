<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Ibtikar\TaniaModelBundle\Validator\Constraints as TaniaAssert;

/**
 * @ORM\Table(name="fee")
 * @ORM\Entity()
 */
class Fee
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
     * @ORM\Column(name="tax_percent", type="decimal", precision=10, scale=2, nullable = true)
     * @Assert\NotBlank(message="fill_mandatory_field")
     */
    private $taxPercent = 0;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prices = new ArrayCollection();
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
     * Set taxPercent
     *
     * @param $taxPercent
     *
     * @return Fee
     */
    public function setTaxPercent($taxPercent)
    {
        $this->taxPercent = $taxPercent;

        return $this;
    }

    /**
     * Get taxPercent
     *
     * @return integer
     */
    public function getTaxPercent()
    {
        return $this->taxPercent;
    }

}
