<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 *
 * @ORM\Table(name="transport")
 * @ORM\Entity
 */
class Transport
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_t", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idT;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrt_place", type="integer", nullable=false)
     */
    private $nbrtPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="type_t", type="string", length=30, nullable=false)
     */
    private $typeT;

    /**
     * @var bool
     *
     * @ORM\Column(name="dispo_t", type="boolean", nullable=false)
     */
    private $dispoT;


}
