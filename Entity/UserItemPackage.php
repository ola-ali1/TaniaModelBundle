<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserItemPackage
 *
 * @ORM\Table(name="user_item_package")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\UserItemPackageRepository")
 */
class UserItemPackage
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
     * @var int
     *
     * @ORM\Column(name="purchasedCount", type="integer")
     */
    private $purchasedCount;

    /**
     * @var int
     *
     * @ORM\Column(name="redeemedCount", type="integer")
     */
    private $redeemedCount;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User", inversedBy="userItemPackages")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Item", inversedBy="userItemPackages")
     */
    protected $item;
    
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
     * Set purchasedCount
     *
     * @param integer $purchasedCount
     *
     * @return UserItemPackage
     */
    public function setPurchasedCount($purchasedCount)
    {
        $this->purchasedCount = $purchasedCount;

        return $this;
    }

    /**
     * Get purchasedCount
     *
     * @return int
     */
    public function getPurchasedCount()
    {
        return $this->purchasedCount;
    }

    /**
     * Set redeemedCount
     *
     * @param integer $redeemedCount
     *
     * @return UserItemPackage
     */
    public function setRedeemedCount($redeemedCount)
    {
        $this->redeemedCount = $redeemedCount;

        return $this;
    }

    /**
     * Get redeemedCount
     *
     * @return int
     */
    public function getRedeemedCount()
    {
        return $this->redeemedCount;
    }

    /**
     * Get redeemedCount
     *
     * @return int
     */
    public function getRedeemableCount()
    {
        return max($this->getPurchasedCount() - $this->getRedeemedCount(), 0);
    }
    
    /**
     * Set user
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $user
     *
     * @return UserItemPackage
     */
    public function setUser(\Ibtikar\TaniaModelBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set item
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Item $item
     *
     * @return UserItemPackage
     */
    public function setItem(\Ibtikar\TaniaModelBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Item
     */
    public function getItem()
    {
        return $this->item;
    }
    
}

