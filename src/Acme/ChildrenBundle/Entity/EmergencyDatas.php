<?php

namespace Acme\ChildrenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * EmergencyDatas
 *
 * @ORM\Table(name="emergency_datas")
 * @ORM\Entity
 */
class EmergencyDatas
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
     * @ORM\Column(name="health_insurance", type="string", length=60, nullable=false)
     */
    private $healthInsurance;

     /**
     * @ORM\ManyToMany(targetEntity="Vaccines", inversedBy="vaccination")
     * @ORM\JoinTable(name="vaccinedates")
     **/

    private $vaccine;

    /**
     * @ORM\OneToOne(targetEntity="Doctors" ,  inversedBy="sos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="doctor", referencedColumnName="id")
     **/

    private $doctor;

    /**
     * @var string
     *
     * @ORM\Column(name="another_contact", type="text", nullable=false)
     */
    private $anotherContact;

    /**
     * @ORM\OneToOne(targetEntity="Children" , inversedBy="sos")
     * @ORM\JoinColumn(name="children_sos", referencedColumnName="id")
     **/
    private $childrenSos; 
    
    public function __construct()
    {
        $this->vaccine = new ArrayCollection();
        //$this->doctor = new ArrayCollection();
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
     * Set healthInsurance
     *
     * @param string $healthInsurance
     * @return EmergencyDatas
     */
    public function setHealthInsurance($healthInsurance)
    {
        $this->healthInsurance = $healthInsurance;
    
        return $this;
    }

    /**
     * Get healthInsurance
     *
     * @return string 
     */
    public function getHealthInsurance()
    {
        return $this->healthInsurance;
    }

    /**
     * Set anotherContact
     *
     * @param string $anotherContact
     * @return EmergencyDatas
     */
    public function setAnotherContact($anotherContact)
    {
        $this->anotherContact = $anotherContact;
    
        return $this;
    }

    /**
     * Get anotherContact
     *
     * @return string 
     */
    public function getAnotherContact()
    {
        return $this->anotherContact;
    }

    /**
     * Add vaccine
     *
     * @param \Acme\ChildrenBundle\Entity\Vaccines $vaccine
     * @return EmergencyDatas
     */
    public function addVaccine(\Acme\ChildrenBundle\Entity\Vaccines $vaccine)
    {
        $this->vaccine[] = $vaccine;
    
        return $this;
    }

    /**
     * Remove vaccine
     *
     * @param \Acme\ChildrenBundle\Entity\Vaccines $vaccine
     */
    public function removeVaccine(\Acme\ChildrenBundle\Entity\Vaccines $vaccine)
    {
        $this->vaccine->removeElement($vaccine);
    }

    /**
     * Get vaccine
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVaccine()
    {
        return $this->vaccine;
    }

    /**
     * Set doctorId
     *
     * @param \Acme\ChildrenBundle\Entity\Doctors $doctor
     * @return EmergencyDatas
     */
    public function setDoctor(\Acme\ChildrenBundle\Entity\Doctors $doctor = null)
    {
        $this->doctor = $doctor;
    
        return $this;
    }

    /**
     * Get doctor
     *
     * @return \Acme\ChildrenBundle\Entity\Doctors 
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * Set childrenSos
     *
     * @param \Acme\ChildrenBundle\Entity\Children $childrenSos
     * @return EmergencyDatas
     */
    public function setChildrenSos(\Acme\ChildrenBundle\Entity\Children $childrenSos = null)
    {
        $this->childrenSos = $childrenSos;
    
        return $this;
    }

    /**
     * Get childrenSos
     *
     * @return \Acme\ChildrenBundle\Entity\Children 
     */
    public function getChildrenSos()
    {
        return $this->childrenSos;
    }
}