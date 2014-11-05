<?php



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
     * @var string
     *
     * @ORM\Column(name="birth", type="string", length=255, nullable=true)
     */
    private $birth;

    /**
     * @var string
     *
     * @ORM\Column(name="date_start", type="string", length=255, nullable=true)
     */
    private $dateStart;

    /**
     * @var string
     *
     * @ORM\Column(name="date_leave", type="string", length=255, nullable=true)
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Families", inversedBy="children")
     * @ORM\JoinTable(name="relationship",
     *   joinColumns={
     *     @ORM\JoinColumn(name="children_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="families_id", referencedColumnName="id")
     *   }
     * )
     */
    private $families;

    /**
     * @var \Kindergartens
     *
     * @ORM\ManyToOne(targetEntity="Kindergartens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kindegarten", referencedColumnName="id")
     * })
     */
    private $kindegarten;

    /**
     * @var \Image
     *
     * @ORM\ManyToOne(targetEntity="Image")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image", referencedColumnName="id")
     * })
     */
    private $image;

    /**
     * @var \Contracts
     *
     * @ORM\ManyToOne(targetEntity="Contracts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contract", referencedColumnName="id")
     * })
     */
    private $contract;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->families = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
