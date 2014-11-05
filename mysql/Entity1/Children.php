<?php

namespace Acme\KinderBundle\Entity;

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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=150, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=45, nullable=true)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth", type="date", nullable=true)
     */
    private $birth;

    /**
     * @var integer
     *
     * @ORM\Column(name="contract_id", type="integer", nullable=false)
     */
    private $contractId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ermergency_date_id", type="integer", nullable=false)
     */
    private $ermergencyDateId;

    /**
     * @var integer
     *
     * @ORM\Column(name="kindergarten_id", type="integer", nullable=false)
     */
    private $kindergartenId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date", nullable=true)
     */
    private $dateStart;

    /**
     * @var string
     *
     * @ORM\Column(name="date_leave", type="string", length=45, nullable=true)
     */
    private $dateLeave;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_online", type="integer", nullable=true)
     */
    private $isOnline;

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


}
