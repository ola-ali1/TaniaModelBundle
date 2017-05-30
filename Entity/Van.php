<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Table(name="van")
 * @ORM\Entity()
 */
class Van
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
     * @ORM\Column(name="total_capacity", type="integer")
     */
    private $totalCapacity;

    /**
     * @ORM\Column(name="current_capacity", type="integer")
     */
    private $currentCapacity;

    /**
     * @ORM\Column(name="van_number", type="string")
     */
    private $vanNumber;

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
     * Set currentCapacity
     *
     * @param string $currentCapacity
     *
     * @return Van
     */
    public function setCurrentCapacity($currentCapacity)
    {
        $this->currentCapacity = $currentCapacity;

        return $this;
    }

    /**
     * Get currentCapacity
     *
     * @return string
     */
    public function getCurrentCapacity()
    {
        return $this->currentCapacity;
    }


    /**
     * Set totalCapacity
     *
     * @param string $totalCapacity
     *
     * @return Van
     */
    public function setTotalCapacity($totalCapacity)
    {
        $this->totalCapacity = $totalCapacity;

        return $this;
    }

    /**
     * Get totalCapacity
     *
     * @return string
     */
    public function getTotalCapacity()
    {
        return $this->totalCapacity;
    }

    /**
     * Set vanNumber
     *
     * @param string $vanNumber
     *
     * @return Van
     */
    public function setVanNumber($vanNumber)
    {
        $this->vanNumber = $vanNumber;

        return $this;
    }

    /**
     * Get vanNumber
     *
     * @return string
     */
    public function getVanNumber()
    {
        return $this->vanNumber;
    }
}
