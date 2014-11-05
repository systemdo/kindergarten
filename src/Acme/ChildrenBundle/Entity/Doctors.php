<?php

namespace Acme\ChildrenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Doctors
 *
 * @ORM\Table(name="doctors")
 * @ORM\Entity
 */
class Doctors
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
     * @ORM\Column(name="surname", type="string", length=80, nullable=true)
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Contact")
     * @ORM\JoinColumn(name="contact", referencedColumnName="id")
     **/
    private $contact;

    /**
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Address")
     * @ORM\JoinColumn(name="address", referencedColumnName="id")
     **/
    
    private $address;

    /**
     * @ORM\OneToOne(targetEntity="EmergencyDatas" ,  mappedBy="doctor")
     **/
    private $sos;

     public function __construct()
    {
        //$this->sos = new ArrayCollection();
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
     * @return Doctors
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
     * Set surname
     *
     * @param string $surname
     * @return Doctors
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    
        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set contact
     *
     * @param \Acme\InformationBundle\Entity\Contact $contact
     * @return Doctors
     */
    public function setContact(\Acme\InformationBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return \Acme\InformationBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set address
     *
     * @param \Acme\InformationBundle\Entity\Address $address
     * @return Doctors
     */
    public function setAddress(\Acme\InformationBundle\Entity\Address $address = null)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return \Acme\InformationBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set sos
     *
     * @param \Acme\ChildrenBundle\Entity\EmergencyDatas $sos
     * @return Doctors
     */
    public function setSos(\Acme\ChildrenBundle\Entity\EmergencyDatas $sos = null)
    {
        $this->sos = $sos;
    
        return $this;
    }

    /**
     * Get sos
     *
     * @return \Acme\ChildrenBundle\Entity\EmergencyDatas 
     */
    public function getSos()
    {
        return $this->sos;
    }
}