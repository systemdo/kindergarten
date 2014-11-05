<?php

namespace Acme\ChildrenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parentage
 *
 * @ORM\Table(name="parentage")
 * @ORM\Entity
 */
class Parentage
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
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="Families", mappedBy="parentageId")
     */
    private $grade;

    public function __construct()
    {
        $this->grade = new ArrayCollection();
    }

}
