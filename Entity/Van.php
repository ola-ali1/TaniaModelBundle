<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="van")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\VanRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"vanNumber"}, message="vanNumber_exist")
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
     * @ORM\Column(name="van_number", type="string")
     * @Assert\NotBlank(message="fill_mandatory_field")
     */
    private $vanNumber;


    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\VanItem",mappedBy="van", cascade={"persist", "remove"})
     */
    protected $vanItems;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\VanDriver",mappedBy="van", cascade={"persist", "remove"})
     */
    protected $vanDrivers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vanItems = new ArrayCollection();
        $this->vanDrivers = new ArrayCollection();
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



    /**
     * Add vanItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\VanItem $vanItem
     *
     * @return Van
     */
    public function addVanItem(\Ibtikar\TaniaModelBundle\Entity\VanItem $vanItem)
    {
        $this->vanItems[] = $vanItem;

        $vanItem->setVan($this);

        return $this;
    }

    /**
     * Remove vanItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\VanItem $vanItem
     */
    public function removeVanItem(\Ibtikar\TaniaModelBundle\Entity\VanItem $vanItem)
    {
        $this->vanItems->removeElement($vanItem);
    }

    /**
     * Get vanItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVanItems()
    {
        return $this->vanItems;
    }

    /**
     * Add vanDriver
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\VanDriver $vanDriver
     *
     * @return Van
     */
    public function addVanDriver(\Ibtikar\TaniaModelBundle\Entity\VanDriver $vanDriver)
    {
        $this->vanDrivers[] = $vanDriver;

        $vanDriver->setVan($this);

        return $this;
    }

    /**
     * Remove vanDriver
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\VanDrivers $vanDriver
     */
    public function removeVanDriver(\Ibtikar\TaniaModelBundle\Entity\VanDriver $vanDriver)
    {
        $this->vanDrivers->removeElement($vanDriver);
    }

    /**
     * Get vanDrivers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVanDrivers()
    {
        return $this->vanDrivers;
    }


    /**
     * Get status
     *
     * @return boolean
     */
    public function getCurrentCapacity()
    {
        if(count($this->vanItems)> 0)
            return $this->vanItems[0]->getCurrentCapacity();
        return 0;
    }
}
