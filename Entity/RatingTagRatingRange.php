<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RatingTagRatingRange
 *
 * @ORM\Table(name="rating_tag_rating_range")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\RatingTagRatingRangeRepository")
 */
class RatingTagRatingRange
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
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\RatingTag", inversedBy="ratingTagRatingRanges")
     */
    private $ratingTag;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\RatingRange", inversedBy="ratingTagRatingRanges")
     */
    private $ratingRange;

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
     * Set ratingTag
     *
     * @param RatingTag $ratingTag
     *
     * @return RatingTagRatingRange
     */
    public function setRatingTag($ratingTag)
    {
        $this->ratingTag = $ratingTag;

        return $this;
    }

    /**
     * Get ratingTag
     *
     * @return RatingTag
     */
    public function getRatingTag()
    {
        return $this->ratingTag;
    }

    /**
     * Set ratingRange
     *
     * @param RatingRange $ratingRange
     *
     * @return RatingTagRatingRange
     */
    public function setRatingRange($ratingRange)
    {
        $this->ratingRange = $ratingRange;

        return $this;
    }

    /**
     * Get ratingRange
     *
     * @return RatingRange
     */
    public function getRatingRange()
    {
        return $this->ratingRange;
    }
}

