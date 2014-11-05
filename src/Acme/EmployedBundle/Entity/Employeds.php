<?php

namespace Acme\EmployedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Employeds
 *
 * @ORM\Table(name="employeds")
 * @ORM\Entity(repositoryClass="Acme\EmployedBundle\Repository\EmployedsRepository")
 * @UniqueEntity("email")
 */
class Employeds
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
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=90, nullable=true)
     */
    private $surname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="Acme\SystemBundle\Entity\FilesSystem" ,  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     **/

    private $image;
    
    /**
     * @var string
     *
     * @ORM\Column(name="birth", type="string", length=15, nullable=true)
     */
    private $birth;

    /**
     * @var integer
     *
     * @ORM\Column(name="password_clock", type="integer", length=6, nullable=true)
     */
    private $passwordClock;


    /**
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Address")
     * @ORM\JoinColumn(name="address", referencedColumnName="id")
     **/
    
    private $address;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Acme\InformationBundle\Entity\Kindergartens", inversedBy="employed")
     * @ORM\JoinColumn(name="employed_kindergarten", referencedColumnName="id")
     */

    private $kindergarten;

    /**
     * @var string
     *
     * @ORM\Column(name="schedule", type="string", length=45, nullable=true)
     */
    private $schedule;

    /**
     * @ORM\ManyToOne(targetEntity="Acme\InformationBundle\Entity\Jobs")
     * @ORM\JoinColumn(name="task", referencedColumnName="id")
     **/
    private $task;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begin", type="date", nullable=true)
     */
    private $begin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ended", type="date", nullable=true)
     */
    private $ended; 
    
    /**
     * @ORM\OneToMany(targetEntity="Acme\KindergartenBundle\Entity\AttendanceEmployed", mappedBy="employed")
     * @ORM\JoinColumn(name="employed")
     *
     */
    protected $attendance;

    /**
     * @ORM\OneToOne(targetEntity="Acme\InformationBundle\Entity\Contact")
     * @ORM\JoinColumn(name="contact", referencedColumnName="id")
     **/
    private $contact;

    /**
     *
     * @ORM\OneToOne(targetEntity="Acme\UsersBundle\Entity\Users", mappedBy="employed")
     */

    private $user;

    public $uploadDir = "employeds/";

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kindergarten = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function getPath()
    {
        return '/uploads/'.$this->image->path.$this->image->name;
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
     * @return Employeds
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
     * @return Employeds
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
     * Set schedule
     *
     * @param string $schedule
     * @return Employeds
     */
    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    
        return $this;
    }

    /**
     * Get schedule
     *
     * @return string 
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * Set task
     *
     * @param string $task
     * @return Employeds
     */
    public function setTask($task)
    {
        $this->task = $task;
    
        return $this;
    }

    /**
     * Get task
     *
     * @return string 
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set begin
     *
     * @param \DateTime $begin
     * @return Employeds
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;
    
        return $this;
    }

    /**
     * Get begin
     *
     * @return \DateTime 
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set ended
     *
     * @param \DateTime $ended
     * @return Employeds
     */
    public function setEnded($ended)
    {
        $this->ended = $ended;
    
        return $this;
    }

    /**
     * Get ended
     *
     * @return \DateTime 
     */
    public function getEnded()
    {
        return $this->ended;
    }

    /**
     * Set address
     *
     * @param \Acme\InformationBundle\Entity\Address $address
     * @return Employeds
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
     * Set kindergarten
     *
     * @param \Acme\InformationBundle\Entity\Kindergartens $kindergarten
     * @return Employeds
     */
    public function setKindergarten(\Acme\InformationBundle\Entity\Kindergartens $kindergarten = null)
    {
        $this->kindergarten = $kindergarten;
    
        return $this;
    }

    /**
     * Get kindergarten
     *
     * @return \Acme\InformationBundle\Entity\Kindergartens 
     */
    public function getKindergarten()
    {
        return $this->kindergarten;
    }



    public function __toString()
    {
        
        return $this->surname;
    }
    
    
    /**
     * Add kindergarten
     *
     * @param \Acme\InformationBundle\Entity\Kindergartens $kindergarten
     * @return Employeds
     */
    public function addKindergarten(\Acme\InformationBundle\Entity\Kindergartens $kindergarten)
    {
        $this->kindergarten[] = $kindergarten;
    
        return $this;
    }

    /**
     * Remove kindergarten
     *
     * @param \Acme\InformationBundle\Entity\Kindergartens $kindergarten
     */
    public function removeKindergarten(\Acme\InformationBundle\Entity\Kindergartens $kindergarten)
    {
        $this->kindergarten->removeElement($kindergarten);
    }

    /**
     * Set birth
     *
     * @param string $birth
     * @return Employeds
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
    
        return $this;
    }

    /**
     * Get birth
     *
     * @return string 
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * Set user
     *
     * @param \Acme\UsersBundle\Entity\Users $user
     * @return Employeds
     */
    public function setUser(\Acme\UsersBundle\Entity\Users $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\UsersBundle\Entity\Users 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set contact
     *
     * @param \Acme\InformationBundle\Entity\Contact $contact
     * @return Employeds
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
     * Set passwordClock
     *
     * @param integer $passwordClock
     * @return Employeds
     */
    public function setPasswordClock()
    {
        $this->passwordClock = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
        //$this->passwordClock = $passwordClock;
    
        return $this;
    }

    /**
     * Get passwordClock
     *
     * @return integer 
     */
    public function getPasswordClock()
    {
        return $this->passwordClock;
    }

    /**
     * Set image
     *
     * @param \Acme\SystemBundle\Entity\FilesSystem $image
     * @return Employeds
     */
    public function setImage(\Acme\SystemBundle\Entity\FilesSystem $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \Acme\SystemBundle\Entity\FilesSystem 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add attendance
     *
     * @param \Acme\KindergartenBundle\Entity\AttendanceEmployed $attendance
     * @return Employeds
     */
    public function addAttendance(\Acme\KindergartenBundle\Entity\AttendanceEmployed $attendance)
    {
        $this->attendance[] = $attendance;
    
        return $this;
    }

    /**
     * Remove attendance
     *
     * @param \Acme\KindergartenBundle\Entity\AttendanceEmployed $attendance
     */
    public function removeAttendance(\Acme\KindergartenBundle\Entity\AttendanceEmployed $attendance)
    {
        $this->attendance->removeElement($attendance);
    }

    /**
     * Get attendance
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttendance()
    {
        return $this->attendance;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Employeds
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
}