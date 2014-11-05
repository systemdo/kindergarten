<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * AttendanceChildren
 *
 * @ORM\Table(name="attendance_children")
 * @ORM\Entity
 */
class AttendanceChildren
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
     * @var boolean
     *
     * @ORM\Column(name="attendance", type="boolean", nullable=false)
     */
    private $attendance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

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
     * @var \Children
     *
     * @ORM\ManyToOne(targetEntity="Children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="child", referencedColumnName="id")
     * })
     */
    private $child;


}
