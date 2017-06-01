<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Table(name="van")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Van
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
     * @ORM\Column(name="total_capacity", type="integer")
     */
    private $totalCapacity;

    /**
     * @ORM\Column(name="current_capacity", type="integer")
     */
    private $currentCapacity;

    /**
     * @ORM\Column(name="van_number", type="string")
     */
    private $vanNumber;

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
        return 'uploads/van-images';
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set currentCapacity
     *
     * @param string $currentCapacity
     *
     * @return Van
     */
    public function setCurrentCapacity($currentCapacity)
    {
        $this->currentCapacity = $currentCapacity;

        return $this;
    }

    /**
     * Get currentCapacity
     *
     * @return string
     */
    public function getCurrentCapacity()
    {
        return $this->currentCapacity;
    }


    /**
     * Set totalCapacity
     *
     * @param string $totalCapacity
     *
     * @return Van
     */
    public function setTotalCapacity($totalCapacity)
    {
        $this->totalCapacity = $totalCapacity;

        return $this;
    }

    /**
     * Get totalCapacity
     *
     * @return string
     */
    public function getTotalCapacity()
    {
        return $this->totalCapacity;
    }

    /**
     * Set vanNumber
     *
     * @param string $vanNumber
     *
     * @return Van
     */
    public function setVanNumber($vanNumber)
    {
        $this->vanNumber = $vanNumber;

        return $this;
    }

    /**
     * Get vanNumber
     *
     * @return string
     */
    public function getVanNumber()
    {
        return $this->vanNumber;
    }
}
