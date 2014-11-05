<?php

namespace Acme\KinderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Families
 *
 * @ORM\Table(name="families")
 * @ORM\Entity
 */
class Families
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
     * @ORM\Column(name="surname", type="string", length=100, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="address_id", type="integer", nullable=true)
     */
    private $addressId;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=50, nullable=true)
     */
    private $job;

    /**
     * @var integer
     *
     * @ORM\Column(name="address_job_id", type="integer", nullable=true)
     */
    private $addressJobId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth", type="date", nullable=true)
     */
    private $birth;

    /**
     * @var integer
     *
     * @ORM\Column(name="document", type="integer", nullable=true)
     */
    private $document;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=60, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="id_contacts", type="string", length=45, nullable=true)
     */
    private $idContacts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime", nullable=true)
     */
    private $dateCreate;

    /**
     * @var string
     *
     * @ORM\Column(name="last_update", type="string", length=45, nullable=true)
     */
    private $lastUpdate;


}
