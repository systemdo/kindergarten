<?php

namespace Acme\KindergartenBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttendanceEmployed
 * @ORM\Table(name="attendance_employed")
 * @ORM\Entity
 */
class AttendanceEmployed
{
   
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

   /**
     * @ORM\ManyToOne(targetEntity="Acme\EmployedBundle\Entity\Employeds", inversedBy="attendance")
     * @ORM\JoinColumn(name="employed", referencedColumnName="id")
     *
     */
    protected $employed;
    
    /**
     * @var \Date
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    protected $date;

     /**
     * @var \Time
     *
     * @ORM\Column(name="clock_in", type="time", nullable=true)
     */
    private $clockIn;

    /**
     * @var \Time
     *
     * @ORM\Column(name="clock_out", type="time", nullable=true)
     */
    private $clockOut;

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
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return AttendanceChildren
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime 
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     * @return AttendanceChildren
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
     * Set child
     *
     * @param \Acme\ChildrenBundle\Entity\children $child
     * @return AttendanceChildren
     */
    public function setChild(\Acme\ChildrenBundle\Entity\children $child = null)
    {
        $this->child = $child;
    
        return $this;
    }

    /**
     * Get child
     *
     * @return \Acme\ChildrenBundle\Entity\children 
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * Set attendanceDate
     *
     * @param \DateTime $attendanceDate
     * @return AttendanceChildren
     */
    public function setAttendanceDate($attendanceDate)
    {
        $this->attendanceDate = $attendanceDate;
    
        return $this;
    }

    /**
     * Get attendanceDate
     *
     * @return \DateTime 
     */
    public function getAttendanceDate()
    {
        return $this->attendanceDate;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return AttendanceEmployed
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set clockIn
     *
     * @param \DateTime $clockIn
     * @return AttendanceEmployed
     */
    public function setClockIn($clockIn)
    {
        $this->clockIn = $clockIn;
    
        return $this;
    }

    /**
     * Get clockIn
     *
     * @return \DateTime 
     */
    public function getClockIn()
    {
        return $this->clockIn;
    }

    /**
     * Set clockOut
     *
     * @param \DateTime $clockOut
     * @return AttendanceEmployed
     */
    public function setClockOut($clockOut)
    {
        $this->clockOut = $clockOut;
    
        return $this;
    }

    /**
     * Get clockOut
     *
     * @return \DateTime 
     */
    public function getClockOut()
    {
        return $this->clockOut;
    }

    /**
     * Set employed
     *
     * @param \Acme\EmployedBundle\Entity\Employeds $employed
     * @return AttendanceEmployed
     */
    public function setEmployed(\Acme\EmployedBundle\Entity\Employeds $employed = null)
    {
        $this->employed = $employed;
    
        return $this;
    }

    /**
     * Get employed
     *
     * @return \Acme\EmployedBundle\Entity\Employeds 
     */
    public function getEmployed()
    {
        return $this->employed;
    }
}