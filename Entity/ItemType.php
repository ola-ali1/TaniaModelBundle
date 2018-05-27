<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * ItemType
 *
 * @ORM\Table(name="item_type")
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class ItemType
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
     * @ORM\Column(name="nameAr", type="string", length=100)
     * @Assert\Length(max=100,min=1)
     * @Assert\NotBlank
     */
    private $nameAr;

    /**
     * @var string
     *
     * @ORM\Column(name="nameEn", type="string", length=100)
     * @Assert\Length(max=30,min=3)
     * @Assert\NotBlank
     */
    private $nameEn;

    /**
     * @var \DateTime $deletedAt
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameAr
     * @param string $nameAr
     * @return ItemType
     */
    public function setNameAr($nameAr)
    {
        $this->nameAr = $nameAr;

        return $this;
    }

    /**
     * Get nameAr
     *
     * @return string
     */
    public function getNameAr()
    {
        return $this->nameAr;
    }

    /**
     * Set NameEn
     *
     * @param string $NameEn
     *
     * @return ItemType
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
        return $this;
    }

    /**
     * Get nameEn
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->NameEn;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return ItemType
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
