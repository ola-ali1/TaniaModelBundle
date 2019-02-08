<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeviceNotification
 *
 * @ORM\Table(name="device_notification")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\DeviceNotificationRepository")
 */
class DeviceNotification
{
    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="titleAr", type="string", length=255)
     */
    private $titleAr;

    /**
     * @var string
     *
     * @ORM\Column(name="titleEn", type="string", length=255)
     */
    private $titleEn;

    /**
     * @var string
     *
     * @ORM\Column(name="bodyAr", type="string", length=255)
     */
    private $bodyAr;

    /**
     * @var string
     *
     * @ORM\Column(name="bodyEn", type="string", length=255)
     */
    private $bodyEn;

    /**
     * @var array
     *
     * @ORM\Column(name="data", type="array")
     */
    private $data;

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
     * Set type
     *
     * @param string $type
     *
     * @return DeviceNotification
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
     * Set titleAr
     *
     * @param string $titleAr
     *
     * @return DeviceNotification
     */
    public function setTitleAr($titleAr)
    {
        $this->titleAr = $titleAr;

        return $this;
    }

    /**
     * Get titleAr
     *
     * @return string
     */
    public function getTitleAr()
    {
        return $this->titleAr;
    }

    /**
     * Set titleEn
     *
     * @param string $titleEn
     *
     * @return DeviceNotification
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
     * Set bodyAr
     *
     * @param string $bodyAr
     *
     * @return DeviceNotification
     */
    public function setBodyAr($bodyAr)
    {
        $this->bodyAr = $bodyAr;

        return $this;
    }

    /**
     * Get bodyAr
     *
     * @return string
     */
    public function getBodyAr()
    {
        return $this->bodyAr;
    }

    /**
     * Set bodyEn
     *
     * @param string $bodyEn
     *
     * @return DeviceNotification
     */
    public function setBodyEn($bodyEn)
    {
        $this->bodyEn = $bodyEn;

        return $this;
    }

    /**
     * Get bodyEn
     *
     * @return string
     */
    public function getBodyEn()
    {
        return $this->bodyEn;
    }

    /**
     * Set data
     *
     * @param array $data
     *
     * @return DeviceNotification
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set user
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $user
     *
     * @return User
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
}
