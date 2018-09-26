<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="static_pages")
 * @ORM\Entity()
 */
class StaticPage
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier_ar", type="integer", nullable=true)
     */
    private $identifierAr;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier_en", type="integer", nullable=true)
     */
    private $identifierEn;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        return $this->id=$id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return integer
     */
    public function getIdentifierAr()
    {
        return $this->identifierAr;
    }

    /**
     * @param integer $identifierAr
     */
    public function setIdentifierAr($identifierAr)
    {
        $this->identifierAr = $identifierAr;
    }

    /**
     * @return integer
     */
    public function getIdentifierEn()
    {
        return $this->identifierEn;
    }

    /**
     * @param integer $identifierEn
     */
    public function setIdentifierEn($identifierEn)
    {
        $this->identifierEn = $identifierEn;
    }

}
