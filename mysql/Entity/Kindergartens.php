<?php

namespace Acme\ChildrenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kindergartens
 *
 * @ORM\Table(name="kindergartens")
 * @ORM\Entity
 */
class Kindergartens
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
     * @ORM\OneToMany(targetEntity="Employeds", mappedBy="kindergartenId")
     */
    private $employedByKindergarten;

    /**
     * @ORM\OneToMany(targetEntity="Children", mappedBy="kindergartenId")
     */
    private $childrenByKindergarten;

    public function __construct()
    {
        $this->childrenByKindergarten = new ArrayCollection();
        $this->employedByKindergarten = new ArrayCollection();
    }
}
