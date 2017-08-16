<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Ibtikar\TaniaModelBundle\Validator\Constraints as TaniaAssert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\ItemRepository")
 * @ORM\HasLifecycleCallbacks()
 * @TaniaAssert\UniqueCityItemPrice
 */
class Item
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
     * @ORM\Column(name="name", type="string")
     */
    private $name;


    /**
     * @ORM\Column(name="default_price",type="decimal", precision=10, scale=2)
     */
    private $defaultPrice;

    /**
     * @var bool
     *
     * @ORM\Column(name="shown", type="boolean", options={"default": true})
     */
    protected $shown = true;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Price",mappedBy="item")
     *
     * @Assert\Valid
     */
    protected $prices;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OrderItem",mappedBy="item")
     */
    protected $orderItems;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\VanItem",mappedBy="item", cascade={"persist"})
     */
    protected $vanItems;

    /**
     * @Assert\Image(
     *     sizeNotDetectedMessage="Image is corrupted"
     * )
     */
    protected $file = null;

    private $temp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * @var \DateTime $deletedAt
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;


    /**
     * @ORM\Column(name="reference_code", type="string")
     */
    private $referenceCode;

    /**
     * @ORM\Column(name="name_en", type="string")
     */
    private $nameEn;

    public function __toString() {
        return $this->name;
    }
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if(isset($this->path))
        {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        }
        else
        {
            $this->path = '';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/item-images';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if(null !== $this->getFile())
        {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if(null === $this->getFile())
        {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if(isset($this->temp))
        {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if(is_file($file))
        {
            unlink($file);
        }
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Article
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prices = new ArrayCollection();
        $this->orderItems = new ArrayCollection();
        $this->vanItems = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set defaultPrice
     *
     * @param string $defaultPrice
     *
     * @return User
     */
    public function setDefaultPrice($defaultPrice)
    {
        $this->defaultPrice = $defaultPrice;

        return $this;
    }

    /**
     * Get defaultPrice
     *
     * @return string
     */
    public function getDefaultPrice()
    {
        return $this->defaultPrice;
    }

    /**
     * Add price
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Price $price
     *
     * @return Price
     */
    public function addPrice(\Ibtikar\TaniaModelBundle\Entity\Price $price)
    {
        $this->prices[] = $price;

        return $this;
    }

    /**
     * Remove price
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Price $price
     */
    public function removePrice(\Ibtikar\TaniaModelBundle\Entity\Price $price)
    {
        $this->prices->removeElement($price);
    }

    /**
     * Get prices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * Add orderItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderItem $orderItem
     *
     * @return OrderItem
     */
    public function addOrderItem(\Ibtikar\TaniaModelBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }

    /**
     * Remove orderItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OrderItem $orderItem
     */
    public function removeOrderItem(\Ibtikar\TaniaModelBundle\Entity\OrderItem $orderItem)
    {
        $this->orderItems->removeElement($orderItem);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Set shown
     *
     * @param boolean $shown
     *
     * @return item
     */
    public function setShown($shown)
    {
        $this->shown = $shown;

        return $this;
    }

    /**
     * Get shown
     *
     * @return bool
     */
    public function getShown()
    {
        return $this->shown;
    }

    /**
     * Get defaultPrice without useless decimal points
     *
     * @return string
     */
    public function getItemPrice()
    {
        return $this->defaultPrice + 0;
    }

    /**
     * Add vanItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\VanItem $vanItem
     *
     * @return Item
     */
    public function addVanItem(\Ibtikar\TaniaModelBundle\Entity\VanItem $vanItem)
    {
        $this->vanItems[] = $vanItem;

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

    private $itemPhoto;

    public function getItemPhoto()
    {
        return $this->getWebPath();
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return this
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
    public function getdeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set reference code
     *
     * @param string $referenceCode
     *
     * @return Article
     */
    public function setReferenceCode($referenceCode)
    {
        $this->referenceCode = $referenceCode;

        return $this;
    }

    /**
     * Get reference code
     *
     * @return string
     */
    public function getReferenceCode()
    {
        return $this->referenceCode;
    }

    /**
     * Set Name En
     *
     * @param string name En
     *
     * @return Article
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get name En
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }


}
