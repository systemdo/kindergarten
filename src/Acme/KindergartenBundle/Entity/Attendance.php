<?php

namespace Acme\KindergartenBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

//use Acme\InformationBundle\Entity\Kindergartens;
use Doctrine\ORM\Mapping as ORM;

class Attendance
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
     * @var boolean
     *
     * @ORM\Column(name="attendance", type="boolean", options={"default" = 0},  nullable=false)
     */
    protected $attendance;
    /**
     * @var \date
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    protected $date;

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
     * Set attendance
     *
     * @param boolean $attendance
     * @return Attendance
     */
    public function setAttendance($attendance)
    {
        $this->attendance = $attendance;
    
        return $this;
    }

    /**
     * Get attendance
     *
     * @return boolean 
     */
    public function getAttendance()
    {
        return $this->attendance;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Attendance
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
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return Attendance
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
     * @return Attendance
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
}