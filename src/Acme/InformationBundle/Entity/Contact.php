<?php

namespace Acme\InformationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity
 */
class Contact
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
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", nullable=true)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="second_phone", type="integer", nullable=true)
     */
    private $secondPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=70, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone_job", type="integer", nullable=true)
     */
    private $phoneJob;

    /**
     * @var integer
     *
     * @ORM\Column(name="second_phone_job", type="integer", nullable=true)
     */
    private $secondPhoneJob;
    
    /**
    * @var integer
    *
    * @ORM\Column(name="fax", type="integer", nullable=true)
    */
    private $fax;



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
     * Set phone
     *
     * @param integer $phone
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set secondPhone
     *
     * @param integer $secondPhone
     * @return Contact
     */
    public function setSecondPhone($secondPhone)
    {
        $this->secondPhone = $secondPhone;
    
        return $this;
    }

    /**
     * Get secondPhone
     *
     * @return integer 
     */
    public function getSecondPhone()
    {
        return $this->secondPhone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phoneJob
     *
     * @param integer $phoneJob
     * @return Contact
     */
    public function setPhoneJob($phoneJob)
    {
        $this->phoneJob = $phoneJob;
    
        return $this;
    }

    /**
     * Get phoneJob
     *
     * @return integer 
     */
    public function getPhoneJob()
    {
        return $this->phoneJob;
    }

    /**
     * Set secondPhoneJob
     *
     * @param integer $secondPhoneJob
     * @return Contact
     */
    public function setSecondPhoneJob($secondPhoneJob)
    {
        $this->secondPhoneJob = $secondPhoneJob;
    
        return $this;
    }

    /**
     * Get secondPhoneJob
     *
     * @return integer 
     */
    public function getSecondPhoneJob()
    {
        return $this->secondPhoneJob;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     * @return Contact
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return integer 
     */
    public function getFax()
    {
        return $this->fax;
    }
}