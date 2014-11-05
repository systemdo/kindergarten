<?php

namespace Acme\FamilyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parentage
 *
 * @ORM\Table(name="parentage")
 * @ORM\Entity
 */
class Parentage
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
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="Families", mappedBy="parentage")
     */
    private $grade;

    public function __construct()
    {
       // $this->grade = new ArrayCollection();
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
     * Set type
     *
     * @param string $type
     * @return Parentage
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
     * Add grade
     *
     * @param \Acme\FamilyBundle\Entity\Families $grade
     * @return Parentage
     */
    public function addGrade(\Acme\FamilyBundle\Entity\Families $grade)
    {
        $this->grade[] = $grade;
    
        return $this;
    }

    /**
     * Remove grade
     *
     * @param \Acme\FamilyBundle\Entity\Families $grade
     */
    public function removeGrade(\Acme\FamilyBundle\Entity\Families $grade)
    {
        $this->grade->removeElement($grade);
    }

    /**
     * Get grade
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrade()
    {
        return $this->grade;
    }

    public function __toString()
    {
        return $this->type;
    }
}