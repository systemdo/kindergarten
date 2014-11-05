<?php

namespace Acme\KinderBundle\Entity;

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
     * @var string
     *
     * @ORM\Column(name="id_contact", type="string", length=45, nullable=true)
     */
    private $idContact;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_address", type="integer", nullable=true)
     */
    private $idAddress;


}
