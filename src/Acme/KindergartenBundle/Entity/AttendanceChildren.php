<?php

namespace Acme\KindergartenBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttendanceChildren
 * @ORM\Table(name="attendance_children")
 * @ORM\Entity(repositoryClass="Acme\KindergartenBundle\Entity\AttendanceChildrenRepository")
 */
class AttendanceChildren
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
     * @ORM\ManyToOne(targetEntity="Acme\ChildrenBundle\Entity\Children", inversedBy="child")
     * @ORM\JoinColumn(name="child")
     *
     */
    protected $child;

    /**
     * @ORM\OneToOne(targetEntity="Acme\UsersBundle\Entity\Users")
     * @ORM\JoinColumn(name="user")
     *
     */
    protected $user;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="attendance_date", type="datetime", nullable=false)
     */
    protected $attendanceDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=true)
     */
    protected $lastUpdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime", nullable=true)
     */
    protected $dateCreate;
    

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
}