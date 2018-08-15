<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserPackage
 *
 * @ORM\Table(name="user_package")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\UserPackageRepository")
 */
class UserPackage
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
     * @var \DateTime
     *
     * @ORM\Column(name="redeemedAt", type="datetime")
     */
    private $redeemedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="pointsEarned", type="integer")
     */
    private $pointsEarned;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User", inversedBy="userPackages")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Package", inversedBy="userPackages")
     */
    protected $package;
    
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
     * Set redeemedAt
     *
     * @param \DateTime $redeemedAt
     *
     * @return UserPackage
     */
    public function setRedeemedAt($redeemedAt)
    {
        $this->redeemedAt = $redeemedAt;

        return $this;
    }

    /**
     * Get redeemedAt
     *
     * @return \DateTime
     */
    public function getRedeemedAt()
    {
        return $this->redeemedAt;
    }

    /**
     * Set pointsEarned
     *
     * @param integer $pointsEarned
     *
     * @return UserPackage
     */
    public function setPointsEarned($pointsEarned)
    {
        $this->pointsEarned = $pointsEarned;

        return $this;
    }

    /**
     * Get pointsEarned
     *
     * @return int
     */
    public function getPointsEarned()
    {
        return $this->pointsEarned;
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
     * Set package
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Package $package
     *
     * @return Package
     */
    public function setPackage(\Ibtikar\TaniaModelBundle\Entity\Package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Package
     */
    public function getPackage()
    {
        return $this->package;
    }
    
}

