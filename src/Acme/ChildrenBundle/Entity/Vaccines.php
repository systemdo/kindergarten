<?php

namespace Acme\ChildrenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vaccines
 *
 * @ORM\Table(name="vaccines")
 * @ORM\Entity
 */
class Vaccines
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
     * @ORM\Column(name="name", type="string", length=60, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="EmergencyDatas", mappedBy="vaccine")
     */
    private $vaccination;

    public function __construct()
    {
        $this->vaccination = new ArrayCollection();
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
     * @return Vaccines
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
     * Add vaccination
     *
     * @param \Acme\ChildrenBundle\Entity\EmergencyDatas $vaccination
     * @return Vaccines
     */
    public function addVaccination(\Acme\ChildrenBundle\Entity\EmergencyDatas $vaccination)
    {
        $this->vaccination[] = $vaccination;
    
        return $this;
    }

    /**
     * Remove vaccination
     *
     * @param \Acme\ChildrenBundle\Entity\EmergencyDatas $vaccination
     */
    public function removeVaccination(\Acme\ChildrenBundle\Entity\EmergencyDatas $vaccination)
    {
        $this->vaccination->removeElement($vaccination);
    }

    /**
     * Get vaccination
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVaccination()
    {
        return $this->vaccination;
    }
}