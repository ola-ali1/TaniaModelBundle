<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Ibtikar\TaniaModelBundle\Validator\Constraints as TaniaAssert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Event\PreUpdateEventArgs;

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
     * @ORM\Column(name="old_default_price",type="decimal", precision=10, scale=2, nullable=true)
     */
    private $oldDefaultPrice;

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
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OfferBuyItem",mappedBy="item")
     */
    protected $offerBuyItems;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\OfferGetItem",mappedBy="item")
     */
    protected $offerGetItems;

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

    /**
     * @ORM\Column(name="sort", type="integer", options={"default": 0})
     */
    private $sort = 0;

    /**
     * @Assert\NotBlank
     * @Assert\Range(min=1)
     * @Assert\Regex(pattern="/^\d+$/")
     * @ORM\Column(name="minimumAmountToOrder", type="integer", options={"default": 1})
     */
    private $minimumAmountToOrder = 1;

    /**
     * @var string
     *
     * @ORM\Column(name="isSynced", type="boolean",  options={"default": 0}, nullable=true)
     */
    protected $isSynced;

    /**
    * @ORM\ManyToOne(targetEntity="Ibtikar\TaniaModelBundle\Entity\ItemAttribute", fetch="EAGER")
    * @ORM\JoinColumn(name="item_attribute_id", referencedColumnName="id", nullable=true)
    */
    protected $attribute;
    
    /**
    * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\ItemBrand")
    * @ORM\JoinColumn(name="item_brand_id", referencedColumnName="id", nullable=true)
    */
    protected $brand;
    
    /**
    * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\ItemPackage")
    * @ORM\JoinColumn(name="item_package_id", referencedColumnName="id", nullable=true)
    */
    protected $package;
    
    /**
    * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\ItemPackageSize")
    * @ORM\JoinColumn(name="item_package_size_id", referencedColumnName="id", nullable=true)
    */
    protected $packageSize;
    
    /**
    * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\ItemType")
    * @ORM\JoinColumn(name="item_type_id", referencedColumnName="id", nullable=true)
    */
    protected $type;
    
    /**
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\ItemHome", mappedBy="item")
     */
    private $itemHome;
    
    /**
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\UserItemPackage", mappedBy="item")
     */
    private $userItemPackages;

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
        $this->offerBuyItems = new ArrayCollection();
        $this->offerGetItems = new ArrayCollection();
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
     * Set sort
     *
     * @param string $sort
     *
     * @return User
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
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
     * Add offerBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OfferBuyItem $offerBuyItem
     *
     * @return OfferBuyItem
     */
    public function addOfferBuyItem(\Ibtikar\TaniaModelBundle\Entity\OfferBuyItem $offerBuyItem)
    {
        $this->offerBuyItems[] = $offerBuyItem;

        return $this;
    }

    /**
     * Remove offerBuyItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OfferBuyItem $offerBuyItem
     */
    public function removeOfferBuyItem(\Ibtikar\TaniaModelBundle\Entity\OfferBuyItem $offerBuyItem)
    {
        $this->offerBuyItems->removeElement($offerBuyItem);
    }

    /**
     * Get offerBuyItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOfferBuyItems()
    {
        return $this->offerBuyItems;
    }
    
    /**
     * Add offerGetItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OfferGetItem $offerGetItem
     *
     * @return OfferGetItem
     */
    public function addOfferGetItem(\Ibtikar\TaniaModelBundle\Entity\OfferGetItem $offerGetItem)
    {
        $this->offerGetItems[] = $offerGetItem;

        return $this;
    }

    /**
     * Remove offerGetItem
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\OfferGetItem $offerGetItem
     */
    public function removeOfferGetItem(\Ibtikar\TaniaModelBundle\Entity\OfferGetItem $offerGetItem)
    {
        $this->offerGetItems->removeElement($offerGetItem);
    }

    /**
     * Get offerGetItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOfferGetItems()
    {
        return $this->offerGetItems;
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

    /**
     * Set applicationLanguage
     *
     * @param string $isSynced
     *
     * @return User
     */
    public function setIsSynced($isSynced)
    {
        $this->isSynced = $isSynced;

        return $this;
    }

    /**
     * Get $isSynced
     *
     * @return string
     */
    public function getIsSynced()
    {
        return $this->isSynced;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersist($event)
    {
        if ($event instanceof  PreUpdateEventArgs ) {
            if ( $event->hasChangedField('isAsynced') == true ) {
                $this->isSynced= false;
            }
        }
        else
        {
            $this->isSynced= false;
        }
    }


    /**
     * Set minimumAmountToOrder
     *
     * @param integer $minimumAmountToOrder
     *
     * @return Item
     */
    public function setMinimumAmountToOrder($minimumAmountToOrder)
    {
        $this->minimumAmountToOrder = $minimumAmountToOrder;

        return $this;
    }

    /**
     * Get minimumAmountToOrder
     *
     * @return integer
     */
    public function getMinimumAmountToOrder()
    {
        return $this->minimumAmountToOrder;
    }
    
    public function getOldDefaultPrice() {
        return $this->oldDefaultPrice;
    }

    public function setOldDefaultPrice($oldDefaultPrice) {
        $this->oldDefaultPrice = $oldDefaultPrice;
        return $this;
    }

    /**
     * @return ItemAttribute
     */
    public function getAttribute() {
        return $this->attribute;
    }

    /**
     * @return ItemBrand
     */
    public function getBrand() {
        return $this->brand;
    }

    /**
     * @return ItemPackage
     */
    public function getPackage() {
        return $this->package;
    }

    /**
     * @return ItemPackageSize
     */
    public function getPackageSize() {
        return $this->packageSize;
    }

    /**
     * @return ItemType
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return Item
     */
    public function setAttribute($attribute) {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * @return Item
     */
    public function setBrand($brand) {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return Item
     */
    public function setPackage($package) {
        $this->package = $package;
        return $this;
    }

    /**
     * @return Item
     */
    public function setPackageSize($packageSize) {
        $this->packageSize = $packageSize;
        return $this;
    }

    /**
     * @return Item
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function getAttributeNameAr()
    {
        return $this->getAttribute() ? $this->getAttribute()->getNameAr() : "";
    }

    public function getAttributeNameEn()
    {
        return $this->getAttribute() ? $this->getAttribute()->getNameEn() : "";
    }
    
    public function getBrandNameAr()
    {
        return $this->getBrand() ? $this->getBrand()->getNameAr() : "";
    }

    public function getBrandNameEn()
    {
        return $this->getBrand() ? $this->getBrand()->getNameEn() : "";
    }
    
    public function getPackageNameAr()
    {
        return $this->getPackage() ? $this->getPackage()->getNameAr() : "";
    }

    public function getPackageNameEn()
    {
        return $this->getPackage() ? $this->getPackage()->getNameEn() : "";
    }
    
    public function getPackageSizeNameAr()
    {
        return $this->getPackageSize() ? $this->getPackageSize()->getNameAr() : "";
    }

    public function getPackageSizeNameEn()
    {
        return $this->getPackageSize() ? $this->getPackageSize()->getNameEn() : "";
    }
    
    public function getTypeNameAr()
    {
        return $this->getType() ? $this->getType()->getNameAr() : "";
    }

    public function getTypeNameEn()
    {
        return $this->getType() ? $this->getType()->getNameEn() : "";
    }
}
