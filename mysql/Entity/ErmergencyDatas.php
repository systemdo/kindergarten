<?php

namespace Acme\ChildrenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErmergencyDatas
 *
 * @ORM\Table(name="ermergency_datas")
 * @ORM\Entity
 */
class ErmergencyDatas
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
     * @ORM\Column(name="health_insurance", type="string", length=60, nullable=true)
     */
    private $healthInsurance;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_vaccine", type="integer", nullable=true)
     *muchos para muchos
     */

    private $idVaccine;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_doctor", type="integer", nullable=true)
     */

    private $idDoctor;

    /**
     * @var string
     *
     * @ORM\Column(name="another_contact", type="text", nullable=true)
     */
    private $anotherContact;


}
