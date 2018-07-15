<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderRatingTag
 *
 * @ORM\Table(name="order_rating_tag")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\OrderRatingTagRepository")
 */
class OrderRatingTag
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
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\RatingTag", inversedBy="orderRatingTags")
     */
    private $ratingTag;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order", inversedBy="orderRatingTags")
     */
    private $order;

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
     * @return OrderRatingTag
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
     * Set order
     *
     * @param Order $order
     *
     * @return OrderRatingTag
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }
}

