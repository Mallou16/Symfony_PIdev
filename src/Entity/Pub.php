<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pub
 *
 * @ORM\Table(name="pub", indexes={@ORM\Index(name="xx", columns={"id_sponsor"})})
 * @ORM\Entity
 */
class Pub
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pub", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPub;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_societe", type="string", length=255, nullable=false)
     */
    private $nomSociete;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var \Sponsor
     *
     * @ORM\ManyToOne(targetEntity="Sponsor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sponsor", referencedColumnName="id_sponsor")
     * })
     */
    private $idSponsor;


}
