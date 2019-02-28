<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @UniqueEntity(fields={"name"})
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="Ibtikar\TaniaModelBundle\Repository\RoleRepository")
 */
class Role
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
     * @var string
     *
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(min = 1, max = 25)
     * @ORM\Column(name="name", type="string", length=25, unique=true)
     */
    private $name;

    /**
     * @var array
     *
     * @Assert\NotBlank(message="You must have at least 1 Permission")
     * @Assert\Count(
     *      min = "1",
     *      minMessage = "You must have at least 1 Permission"
     * )
     * @ORM\Column(name="permissions", type="array")
     */
    private $permissions = array();

    /**
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
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
     * @return Role
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
     * Set permissions
     *
     * @param array $permissions
     *
     * @return Role
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;

        return $this;
    }

    /**
     * Get permissions
     *
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}
