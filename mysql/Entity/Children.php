<?php

namespace Acme\ChildrenBundle\Entity;

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
     * @ORM\ManyToOne(targetEntity="Contracts", inversedBy="childrenByContract")
     * @ORM\JoinColumn(name="contract_id", referencedColumnName="id")
     */

    private $contractId;

   
    /**
     * @ORM\OneToOne(targetEntity="ErmergencyDatas")
     * @ORM\JoinColumn(name="ermergency_date_id", referencedColumnName="id")
     **/

    private $ermergencyDateId;
     /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Kindergartens", inversedBy="childrenByKindergarten")
     * @ORM\JoinColumn(name="kindergarten_id", referencedColumnName="id")
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

    /**
     * @ORM\ManyToMany(targetEntity="Families", inversedBy="ourChildren")
     * @ORM\JoinTable(name="relationship")
     **/

    private $family;

    public function __construct()
    {
        $this->family = new ArrayCollection();
    }
}
