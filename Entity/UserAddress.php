<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UserAddress
 *
 * @ORM\Table(name="user_address", indexes={@ORM\Index(name="created_at", columns={"created_at"})})
 * @ORM\Entity()
 */
class UserAddress
{

    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 3, max = 20, maxMessage="addressTitle_length_not_valid", minMessage="addressTitle_length_not_valid")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=400, nullable=false)
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 4, max = 300, maxMessage="address_length_not_valid", minMessage="address_length_not_valid")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", precision=14, scale=14, options={"default": 0}, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field")
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal", precision=14, scale=14, options={"default": 0}, nullable=true)
     * @Assert\NotBlank(message="fill_mandatory_field")
     */
    private $latitude;


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
     * Set address
     *
     * @param string $address
     *
     * @return UserAddress
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return UserAddress
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return UserAddress
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @ORM\ManyToOne(targetEntity="\Ibtikar\TaniaModelBundle\Entity\User", inversedBy="addresses")
     */
    protected $user;

    /**
     * Set user
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\User $user
     *
     * @return UserAddress
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

    /**
     * Set title
     *
     * @param string $title
     *
     * @return UserAddress
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
}
