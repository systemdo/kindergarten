<?php

namespace Acme\InformationBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contracts
 *
 * @ORM\Table(name="contracts")
 * @ORM\Entity
 */
class Contracts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="begin", type="string", length=45, nullable=true)
     */
    private $begin;

    /**
     * @var string
     *
     * @ORM\Column(name="date_end", type="string", length=45, nullable=true)
     */
    private $dateEnd;
    
     /**
     * @ORM\OneToMany(targetEntity="Acme\ChildrenBundle\Entity\Children", mappedBy="contract")
     */
    protected $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }


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
     * Set name
     *
     * @param string $name
     * @return Contracts
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
     * Set description
     *
     * @param string $description
     * @return Contracts
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set begin
     *
     * @param string $begin
     * @return Contracts
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;
    
        return $this;
    }

    /**
     * Get begin
     *
     * @return string 
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set dateEnd
     *
     * @param string $dateEnd
     * @return Contracts
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    
        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return string 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    
    /**
     * Add children
     *
     * @param \Acme\ChildrenBundle\Entity\Children $children
     * @return Contracts
     */
    public function addChildren(\Acme\ChildrenBundle\Entity\Children $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Acme\ChildrenBundle\Entity\Children $children
     */
    public function removeChildren(\Acme\ChildrenBundle\Entity\Children $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    public function __toString()
    {
         return $this->name;
    }
}