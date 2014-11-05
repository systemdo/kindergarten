<?php

namespace Acme\ChildrenBundle\Entity;

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
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     **/
    
    private $addressId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Kindergartens", inversedBy="employedByKindergarten")
     * @ORM\JoinColumn(name="kindergarten_id", referencedColumnName="id")
     */

    private $kindergartenId;

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
     * @ORM\OneToOne(targetEntity="Contact")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     **/
    private $contactId;


}
