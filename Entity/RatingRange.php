<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RatingRange
 *
 * @ORM\Table(name="rating_range")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\RatingRangeRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class RatingRange
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
     * @var string
     *
     * @ORM\Column(name="start", type="decimal", precision=4, scale=2)
     */
    private $start;

    /**
     * @var string
     *
     * @ORM\Column(name="end", type="decimal", precision=4, scale=2)
     */
    private $end;

    /**
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\RatingTagRatingRange", mappedBy="ratingRange")
     */
    private $ratingTagRatingRanges;

    /**
     * @var \DateTime $deletedAt
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

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
     * Set start
     *
     * @param string $start
     *
     * @return RatingRange
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param string $end
     *
     * @return RatingRange
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    public function getRatingTagRatingRanges() 
    {
        return $this->ratingTagRatingRanges;
    }

    public function setRatingTagRatingRange($ratingTagRatingRanges) 
    {
        $this->ratingTagRatingRanges = $ratingTagRatingRanges;
        return $this;
    }
    
    public function getRatingTagNamesEn()
    {
        $string = '';
        foreach ($this->ratingTagRatingRanges as $ratingTagRatingRange) {
            $string .= "<div class='rating-tag'>" . $ratingTagRatingRange->getRatingTag()->getNameEn() . "</div>";
        }
        return $string;
    }
    
    public function getRatingTagNamesAr() 
    {
        $string = '';
        foreach ($this->ratingTagRatingRanges as $ratingTagRatingRange) {
            $string .= "<div class='rating-tag'>" . $ratingTagRatingRange->getRatingTag()->getName() . "</div>";
        }
        return $string;
    }

    /**    
     * @return RatingRange
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

