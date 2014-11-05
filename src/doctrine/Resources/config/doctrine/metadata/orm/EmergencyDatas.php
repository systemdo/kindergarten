<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * EmergencyDatas
 *
 * @ORM\Table(name="emergency_datas")
 * @ORM\Entity
 */
class EmergencyDatas
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
     * @ORM\Column(name="health_insurance", type="string", length=60, nullable=false)
     */
    private $healthInsurance;

    /**
     * @var string
     *
     * @ORM\Column(name="another_contact", type="text", nullable=false)
     */
    private $anotherContact;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Vaccines", inversedBy="emergencydatas")
     * @ORM\JoinTable(name="vaccinedates",
     *   joinColumns={
     *     @ORM\JoinColumn(name="emergencydatas_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="vaccines_id", referencedColumnName="id")
     *   }
     * )
     */
    private $vaccines;

    /**
     * @var \Doctors
     *
     * @ORM\ManyToOne(targetEntity="Doctors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="doctor", referencedColumnName="id")
     * })
     */
    private $doctor;

    /**
     * @var \Children
     *
     * @ORM\ManyToOne(targetEntity="Children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="children_sos", referencedColumnName="id")
     * })
     */
    private $childrenSos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vaccines = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
