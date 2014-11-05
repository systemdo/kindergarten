<?php

namespace Acme\ChildrenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
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
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="rule_id", type="integer", nullable=false)
     */
    private $ruleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="employed_id", type="integer", nullable=false)
     */
    private $employedId;

    /**
     * @var integer
     *
     * @ORM\Column(name="employed_contact_id", type="integer", nullable=false)
     */
    private $employedContactId;

    /**
     * @var integer
     *
     * @ORM\Column(name="employed_address_id", type="integer", nullable=false)
     */
    private $employedAddressId;


}
