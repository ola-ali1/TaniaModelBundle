<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * Reason
 *
 * @ORM\Table(name="reason")
 * @ORM\Entity()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Reason
{

    use \Ibtikar\ShareEconomyToolsBundle\Entity\TrackableTrait;

    const TYPE_CLOSE = 'close_request';
    const TYPE_RETURN = 'return_request';

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
     * @ORM\Column(name="reasonAr", type="string", length=190)
     * @Assert\Length(max=30,min=3)
     * @Assert\NotBlank
     */
    private $reasonAr;

    /**
     * @var string
     *
     * @ORM\Column(name="reasonEn", type="string", length=190)
     * @Assert\Length(max=30,min=3)
     * @Assert\NotBlank
     */
    private $reasonEn;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="string", length=30)
     */
    private $type;

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
     * Set reasonAr
     *
     * @param string $reasonAr
     *
     * @return Reason
     */
    public function setReasonAr($reasonAr)
    {
        $this->reasonAr = $reasonAr;

        return $this;
    }

    /**
     * Get reasonAr
     *
     * @return string
     */
    public function getReasonAr()
    {
        return $this->reasonAr;
    }

    /**
     * Set reasonEn
     *
     * @param string $reasonEn
     *
     * @return RejectionReason
     */
    public function setReasonEn($reasonEn)
    {
        $this->reasonEn = $reasonEn;

        return $this;
    }

    /**
     * Get reasonEn
     *
     * @return string
     */
    public function getReasonEn()
    {
        return $this->reasonEn;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return RejectionReason
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return RejectionReason
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
