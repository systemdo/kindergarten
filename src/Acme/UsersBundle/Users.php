<?php

namespace Acme\UsersBundle\Entity;
 
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
  * @ORM\Entity
  * @ORM\Table(name="users")
  * @UniqueEntity("username")
  * @UniqueEntity("email")
  */
class Users implements UserInterface, \Serializable
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
    * @ORM\Column(name="username", type="string", length=255)
    */
    protected $username;
 
    /**
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string",  unique=true, length=90)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150)
     */
    private $email;
 
    /**
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    protected $salt;
 
    /**
     * se utilizó user_roles para no hacer conflicto al aplicar ->toArray en getRoles()
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinTable(name="roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="roles", referencedColumnName="id")}
     * )
     */
    protected $roles;
    
    /**
     *
     * @ORM\OneToOne(targetEntity="Acme\EmployedBundle\Entity\Employeds", inversedBy="user")
     * @ORM\JoinColumn(name="employed", referencedColumnName="id")
     */

    private $employed;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Acme\InformationBundle\Entity\Kindergartens", inversedBy="user")
     * @ORM\JoinColumn(name="user_kindergarten", referencedColumnName="id")
     */

    private $kindergarten;

    public $passwMail;

    protected $confirm_password;

    public function __construct()
    {
        //$this->roles = new \Doctrine\Common\Collections\ArrayCollection();
       // $this->employed = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }


    public function setConfirmPassword($confirm)
    {
        $this->confirm_password = $confirm;
    
        return $this;
    }

    function isEqualPassword()
    {
        return $this->confirm_password == $this->password;
    }
    
    public function generatePassword()
    {
        $tring = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        //$tringabcdefghijklmnopqrstuvwxyz"
        $password = $tring[rand(0,25)]. $tring[rand(0,25)]. rand(0,9). rand(0,9);
        $password .=rand(0,9) .rand(0,9). strtolower($tring[rand(0,25)]).strtolower($tring[rand(0,25)]);   
        return $password;
        //return md5($password);
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
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        //$password = $this->generatePassword();
        
        //to send for email
        //$this->passwMail = $password;

        $this->password = $password;
        //$this->password = md5($password);
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Users
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }


    public function setRoles(\Acme\UsersBundle\Entity\Role $roles)
    {
        
        $this->$roles = $roles;
        //var_dump($roles);die();
        return $this;
    }
    

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        //die('ho');
        return array($this->roles);
        //return $this->roles->toArray();
    }

    /**
     * Erases the user credentials.
     */
    public function eraseCredentials() {
 
    }

   public function __toString() 
   {    //var_dump($this->roles);die();
        return $this->roles->getRule();
   }


     /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Users
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
     * @return Users
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
     * Set email
     *
     * @param string $email
     * @return Users
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