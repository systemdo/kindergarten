<?php

namespace Acme\KinderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employeds
 *
 * @ORM\Table(name="employeds")
 * @ORM\Entity
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
     * @var integer
     *
     * @ORM\Column(name="id_adress", type="integer", nullable=true)
     */
    private $idAdress;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_office", type="integer", nullable=true)
     */
    private $idOffice;

    /**
     * @var string
     *
     * @ORM\Column(name="schedule", type="string", length=45, nullable=true)
     */
    private $schedule;

    /**
     * @var string
     *
     * @ORM\Column(name="task", type="string", length=45, nullable=true)
     */
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
     * @var integer
     *
     * @ORM\Column(name="id_contact", type="integer", nullable=true)
     */
    private $idContact;


}
