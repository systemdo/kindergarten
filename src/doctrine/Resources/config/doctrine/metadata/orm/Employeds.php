<?php



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
     * @var string
     *
     * @ORM\Column(name="birth", type="string", length=15, nullable=true)
     */
    private $birth;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=90, nullable=true)
     */
    private $surname;

    /**
     * @var \Contact
     *
     * @ORM\ManyToOne(targetEntity="Contact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contact", referencedColumnName="id")
     * })
     */
    private $contact;

    /**
     * @var \Address
     *
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address", referencedColumnName="id")
     * })
     */
    private $address;


}
