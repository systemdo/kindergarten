<?php

namespace Acme\FamilyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Families
 *
 * @ORM\Table(name="families")
 * @ORM\Entity
 */
class Families
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
     * @ORM\Column(name="surname", type="string", length=100, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

     /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Parentage", inversedBy="grade")
     * @ORM\JoinColumn(name="parentage", referencedColumnName="id")
     */
     
     private $parentage;

    /**
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Address")
     * @ORM\JoinColumn(name="address", referencedColumnName="id")
     **/

    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=50, nullable=true)
     */
    private $job;

    /**
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Address")
     * @ORM\JoinColumn(name="address_job", referencedColumnName="id")
     **/

    private $addressJob;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth", type="date", nullable=true)
     */
    private $birth;

    /**
     * @var integer
     *
     * @ORM\Column(name="document", type="integer", nullable=true)
     */
    private $document;

    /**
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Contact")
     * @ORM\JoinColumn(name="contact", referencedColumnName="id")
     **/
    private $contact;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime", nullable=true)
     */
    private $dateCreate;

    /**
     * @var string
     *
     * @ORM\Column(name="last_update", type="string", length=45, nullable=true)
     */
    private $lastUpdate;

        /**
         * @ORM\ManyToMany(targetEntity="Acme\ChildrenBundle\Entity\Children", mappedBy="family")
         **/

        private $ourChildren;

    public function __construct()
    {
        $this->ourChildren = new ArrayCollection();
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
     * Set surname
     *
     * @param string $surname
     * @return Families
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
     * Set name
     *
     * @param string $name
     * @return Families
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
     * Set job
     *
     * @param string $job
     * @return Families
     */
    public function setJob($job)
    {
        $this->job = $job;
    
        return $this;
    }

    /**
     * Get job
     *
     * @return string 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set birth
     *
     * @param \DateTime $birth
     * @return Families
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    
        return $this;
    }

    /**
     * Get birth
     *
     * @return \DateTime 
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set document
     *
     * @param integer $document
     * @return Families
     */
    public function setDocument($document)
    {
        $this->document = $document;
    
        return $this;
    }

    /**
     * Get document
     *
     * @return integer 
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     * @return Families
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
    
        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime 
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set lastUpdate
     *
     * @param string $lastUpdate
     * @return Families
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return string 
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set parentage
     *
     * @param \Acme\FamilyBundle\Entity\Parentage $parentage
     * @return Families
     */
    public function setParentage(\Acme\FamilyBundle\Entity\Parentage $parentage = null)
    {
        $this->parentage = $parentage;
    
        return $this;
    }

    /**
     * Get parentage
     *
     * @return \Acme\FamilyBundle\Entity\Parentage 
     */
    public function getParentage()
    {
        return $this->parentage;
    }

    /**
     * Set address
     *
     * @param \Acme\InformationBundle\Entity\Address $address
     * @return Families
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
     * Set addressJob
     *
     * @param \Acme\InformationBundle\Entity\Address $addressJob
     * @return Families
     */
    public function setAddressJob(\Acme\InformationBundle\Entity\Address $addressJob = null)
    {
        $this->addressJob = $addressJob;
    
        return $this;
    }

    /**
     * Get addressJob
     *
     * @return \Acme\InformationBundle\Entity\Address 
     */
    public function getAddressJob()
    {
        return $this->addressJob;
    }

    /**
     * Set contact
     *
     * @param \Acme\InformationBundle\Entity\Contact $contact
     * @return Families
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
     * Add ourChildren
     *
     * @param \Acme\ChildrenBundle\Entity\Children $ourChildren
     * @return Families
     */
    public function addOurChildren(\Acme\ChildrenBundle\Entity\Children $ourChildren)
    {
        $this->ourChildren[] = $ourChildren;
        $ourChildren->addFamily($this);
        return $this;
    }

    /**
     * Remove ourChildren
     *
     * @param \Acme\ChildrenBundle\Entity\Children $ourChildren
     */
    public function removeOurChildren(\Acme\ChildrenBundle\Entity\Children $ourChildren)
    {
        $this->ourChildren->removeElement($ourChildren);
    }

    /**
     * Get ourChildren
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOurChildren()
    {
        return $this->ourChildren;
    }
}