<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Vaccines
 *
 * @ORM\Table(name="vaccines")
 * @ORM\Entity
 */
class Vaccines
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EmergencyDatas", mappedBy="vaccines")
     */
    private $emergencydatas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->emergencydatas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
