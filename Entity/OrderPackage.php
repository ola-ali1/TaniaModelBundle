<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * OrderPackage
 *
 * @ORM\Table(name="order_package")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\OrderPackageRepository")
 */
class OrderPackage
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderPackageBuyItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Package", inversedBy="orderPackages")
     */
    protected $package;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Order", inversedBy="orderPackages")
     */
    protected $order;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=100, nullable=true)
     */
    private $titleEn;

    /**
     * @var string
     *
     * @ORM\Column(name="description_public", type="text", nullable=true)
     */
    private $descriptionPublic;

    /**
     * @var string
     *
     * @ORM\Column(name="description_public_en", type="text", nullable=true)
     */
    private $descriptionPublicEn;

    /**
     * @var string
     *
     * @ORM\Column(name="get_amount", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $getAmount;

    /**
     *
     * @Assert\NotBlank
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderPackageBuyItem",mappedBy="orderPackage")
     */
    protected $orderPackageBuyItems;

    /**
     * @ORM\Column(name="count", type="integer", options={"default": 0})
     */
    private $count;

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
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
     * Set price
     *
     * @param string $price
     *
     * @return OrderPackage
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return OrderPackage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleEn
     *
     * @param string $titleEn
     *
     * @return OrderPackage
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;

        return $this;
    }

    /**
     * Get titleEn
     *
     * @return string
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * Set descriptionPublic
     *
     * @param string $descriptionPublic
     *
     * @return OrderPackage
     */
    public function setDescriptionPublic($descriptionPublic)
    {
        $this->descriptionPublic = $descriptionPublic;

        return $this;
    }

    /**
     * Get descriptionPublic
     *
     * @return string
     */
    public function getDescriptionPublic()
    {
        return $this->descriptionPublic;
    }

    /**
     * Set descriptionPublicEn
     *
     * @param string $descriptionPublicEn
     *
     * @return OrderPackage
     */
    public function setDescriptionPublicEn($descriptionPublicEn)
    {
        $this->descriptionPublicEn = $descriptionPublicEn;

        return $this;
    }

    /**
     * Get descriptionPublicEn
     *
     * @return string
     */
    public function getDescriptionPublicEn()
    {
        return $this->descriptionPublicEn;
    }

    /**
     * Set getAmount
     *
     * @param string $getAmount
     *
     * @return OrderPackage
     */
    public function setGetAmount($getAmount)
    {
        $this->getAmount = $getAmount;

        return $this;
    }

    /**
     * Get getAmount
     *
     * @return string
     */
    public function getGetAmount()
    {
        return $this->getAmount;
    }

    /**
     * Add orderPackageBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderPackageBuyItem $orderPackageBuyItem
     *
     * @return OrderPackageBuyItem
     */
    public function addOrderPackageBuyItem(OrderPackageBuyItem $orderPackageBuyItem)
    {
        $this->orderPackageBuyItems[] = $orderPackageBuyItem;

        return $this;
    }

    /**
     * Remove orderPackageBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderPackageBuyItem $orderPackageBuyItem
     */
    public function removeOrderPackageBuyItem(OrderPackageBuyItem $orderPackageBuyItem)
    {
        $this->orderPackageBuyItems->removeElement($orderPackageBuyItem);
    }

    /**
     * Get orderPackageBuyItems
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getOrderPackageBuyItems()
    {
        return $this->orderPackageBuyItems;
    }

    /**
     * Set package
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Package $package
     *
     * @return OrderPackage
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

    /**
     * Set order
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Order $order
     *
     * @return OrderPackage
     */
    public function setOrder(\Ibtikar\TaniaModelBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Ibtikar\TaniaModelBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @ORM\PostPersist
     */
    public function postPersistCallback(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        /* @var Package $package */
        $package = $this->package;

        /* @var PackageBuyItem $buyItem */
        foreach ($package->getPackageBuyItems() as $buyItem) {
            /* @var $orderPackageBuyItem OrderPackageBuyItem */
            $orderPackageBuyItem = new OrderPackageBuyItem();
            $orderPackageBuyItem->setPrice($buyItem->getPrice());
            $orderPackageBuyItem->setName($buyItem->getName());
            $orderPackageBuyItem->setNameEn($buyItem->getNameEn());
            $orderPackageBuyItem->setCount($buyItem->getCount());
            $orderPackageBuyItem->setItem($buyItem->getItem());
            $orderPackageBuyItem->setOrderPackage($this);
            $this->addOrderPackageBuyItem($orderPackageBuyItem);
            $em->persist($orderPackageBuyItem);
        }
        $em->flush();
    }
}
