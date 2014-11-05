<?php

namespace Acme\InformationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Kindergartens
 *
 * @ORM\Table(name="kindergartens")
 * @ORM\Entity
 * @UniqueEntity("name")
 */
class Kindergartens
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
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Address")
     * @ORM\JoinColumn(name="address", referencedColumnName="id")
     **/
    private $address;

    /**
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Contact")
     * @ORM\JoinColumn(name="contact", referencedColumnName="id")
     **/
    private $contact;

    /**
     * @ORM\ManyToMany(targetEntity="Acme\EmployedBundle\Entity\Employeds", mappedBy="kindergarten")
     * @ORM\JoinColumn(name="employed_kindergarten", referencedColumnName="id")
     */
    private $employed;

    /**
    * @ORM\OneToMany(targetEntity="Acme\ChildrenBundle\Entity\Children", mappedBy="kindergarten")
    */
    private $children;

    /**
     * @ORM\ManyToMany(targetEntity="Acme\UsersBundle\Entity\Users", mappedBy="kindergarten")
     * @ORM\JoinColumn(name="user_kindergarten", referencedColumnName="id")
     **/

    private $user;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->employed = new ArrayCollection();
    }

     function __toString()
     {
        return $this->name;
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
     * @return Kindergartens
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
     * Add employed
     *
     * @param \Acme\EmployedBundle\Entity\Employeds $employed
     * @return Kindergartens
     */
    public function addEmployed(\Acme\EmployedBundle\Entity\Employeds $employed)
    {
        $this->employed[] = $employed;
    
        return $this;
    }

    /**
     * Remove employed
     *
     * @param \Acme\EmployedBundle\Entity\Employeds $employed
     */
    public function removeEmployed(\Acme\EmployedBundle\Entity\Employeds $employed)
    {
        $this->employed->removeElement($employed);
    }

    /**
     * Get employed
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmployed()
    {
        return $this->employed;
    }

    /**
     * Add children
     *
     * @param \Acme\ChildrenBundle\Entity\Children $children
     * @return Kindergartens
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

    /**
     * Set address
     *
     * @param \Acme\InformationBundle\Entity\Address $address
     * @return Kindergartens
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
     * Set contact
     *
     * @param \Acme\InformationBundle\Entity\Contact $contact
     * @return Kindergartens
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
     * Add user
     *
     * @param \Acme\UsersBundle\Entity\Users $user
     * @return Kindergartens
     */
    public function addUser(\Acme\UsersBundle\Entity\Users $user)
    {
        $this->user[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param \Acme\UsersBundle\Entity\Users $user
     */
    public function removeUser(\Acme\UsersBundle\Entity\Users $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
}