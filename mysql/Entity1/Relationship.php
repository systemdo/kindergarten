<?php

namespace Acme\KinderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relationship
 *
 * @ORM\Table(name="relationship")
 * @ORM\Entity
 */
class Relationship
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
     * @var integer
     *
     * @ORM\Column(name="child_id", type="integer", nullable=true)
     */
    private $childId;

    /**
     * @var integer
     *
     * @ORM\Column(name="family_id", type="integer", nullable=true)
     */
    private $familyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parentage_id", type="integer", nullable=false)
     */
    private $parentageId;


}
