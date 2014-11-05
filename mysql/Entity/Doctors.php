<?php

namespace Acme\ChildrenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doctors
 *
 * @ORM\Table(name="doctors")
 * @ORM\Entity
 */
class Doctors
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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=80, nullable=true)
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity="Contact")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     **/
    private $contactId;

    /**
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     **/
    
    private $adressId;


}
