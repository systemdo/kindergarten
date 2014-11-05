<?php


namespace Acme\ChildrenBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
//Acme\EmployedBundle\AcmeEmployedBundle
//use Acme\InformationBundle\Entity\Contracts;
//use Acme\InformationBundle\Entity\Kindergartens;
use Doctrine\ORM\Mapping as ORM;

/**
 * Children
 *
 * @ORM\Table(name="children")
 * @ORM\Entity
 */
class Children
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=150, nullable=false)
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity="Acme\SystemBundle\Entity\FilesSystem" ,  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     **/

    private $image;

    /**
     * @var \string
     *
     * @ORM\Column(name="birth", type="string", nullable=true)
     */
    private $birth;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Acme\InformationBundle\Entity\Contracts", inversedBy="children")
     * @ORM\JoinColumn(name="contract", referencedColumnName="id")
     */

    private $contract;
   
     /**
     *
     * @ORM\ManyToOne(targetEntity="Acme\InformationBundle\Entity\Kindergartens", inversedBy="children")
     * @ORM\JoinColumn(name="kindegarten", referencedColumnName="id")
     */

    private $kindergarten;

    /**
     * @ORM\OneToMany(targetEntity="Acme\KindergartenBundle\Entity\AttendanceChildren", mappedBy="attendance")
     **/

    protected $attendance;
    /**
     * @var \string
     *
     * @ORM\Column(name="date_start", type="string", nullable=true)
     */
    private $dateStart;

    /**
     * @var \string
     *
     * @ORM\Column(name="date_leave", type="string", nullable=true)
     */
    private $dateLeave;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="EmergencyDatas" , mappedBy="childrenSos" ,cascade={"persist", "remove"})
     **/
    private $sos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=true)
     */
    private $lastUpdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime", nullable=true)
     */
    private $dateCreate;

    /**
     * @ORM\ManyToMany(targetEntity="Acme\FamilyBundle\Entity\Families", inversedBy="ourChildren")
     * @ORM\JoinTable(name="relationship")
     **/

    private $family;

    public $uploadDir = "children/";
   
    public function __construct()
    {
        //$this->family = new ArrayCollection();

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
     * @return Children
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
     * @return Children
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
     * Set image
     *
     * @param \Acme\SystemBundle\Entity\FilesSystem $image
     * @return Children
     */
    public function setImage( \Acme\SystemBundle\Entity\FilesSystem $image = null)
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
     * Set birth
     *
     * @param \DateTime $birth
     * @return Children
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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Children
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    
        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateLeave
     *
     * @param \DateTime $dateLeave
     * @return Children
     */
    public function setDateLeave($dateLeave)
    {
        $this->dateLeave = $dateLeave;
    
        return $this;
    }

    /**
     * Get dateLeave
     *
     * @return \DateTime 
     */
    public function getDateLeave()
    {
        return $this->dateLeave;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Children
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set isOnline
     *
     * @param integer $isOnline
     * @return Children
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;
    
        return $this;
    }

    /**
     * Get isOnline
     *
     * @return integer 
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return Children
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
     * @return Children
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
     * Set kindergarten
     *
     * @param \Acme\InformationBundle\Entity\Kindergartens $kindergartenId
     * @return Children
     */
    public function setKindergarten(\Acme\InformationBundle\Entity\Kindergartens $kindergarten= null)
    {
        $this->kindergarten = $kindergarten;
    
        return $this;
    }

    /**
     * Get kindergartenId
     *
     * @return \Acme\InformationBundle\Entity\Kindergartens 
     */
    public function getKindergarten()
    {
        return $this->kindergarten;
    }

    /**
     * Add family
     *
     * @param \Acme\FamilyBundle\Entity\Families $family
     * @return Children
     */
    public function addFamily(\Acme\FamilyBundle\Entity\Families $family)
    {
        $this->family[] = $family;
    
        return $this;
    }

    /**
     * Remove family
     *
     * @param \Acme\FamilyBundle\Entity\Families $family
     */
    public function removeFamily(\Acme\FamilyBundle\Entity\Families $family)
    {
        $this->family->removeElement($family);
    }

    /**
     * Get family
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFamily()
    {
        //var_dump($this->family);
        return $this->family;
    }

    public function __toString()
    {
         return $this->name;
    }

    /**
     * Set contract
     *
     * @param \Acme\InformationBundle\Entity\Contracts $contract
     * @return Children
     */
    public function setContract(\Acme\InformationBundle\Entity\Contracts $contract = null)
    {
        $this->contract = $contract;
    
        return $this;
    }

    /**
     * Get contract
     *
     * @return \Acme\InformationBundle\Entity\Contracts 
     */
    public function getContract()
    {
        return $this->contract;
    }


    /**
     * Add attendance
     *
     * @param \Acme\KindergartenBundle\Entity\AttendanceChildren $attendance
     * @return Children
     */
    public function addAttendance(\Acme\KindergartenBundle\Entity\AttendanceChildren $attendance)
    {
        $this->attendance[] = $attendance;
    
        return $this;
    }

    /**
     * Remove attendance
     *
     * @param \Acme\KindergartenBundle\Entity\AttendanceChildren $attendance
     */
    public function removeAttendance(\Acme\KindergartenBundle\Entity\AttendanceChildren $attendance)
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
     * Set sos
     *
     * @param \Acme\ChildrenBundle\Entity\EmergencyDatas $sos
     * @return Children
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