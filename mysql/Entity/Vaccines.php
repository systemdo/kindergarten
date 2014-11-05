<?php

namespace Acme\ChildrenBundle\Entity;

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


}
