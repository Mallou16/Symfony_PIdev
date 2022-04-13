<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Camping
 *
 * @ORM\Table(name="camping")
 * @ORM\Entity
 */
class Camping
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_camp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCamp;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_place", type="integer", nullable=false)
     */
    private $nbrPlace;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=30, nullable=false)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_deb", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateDeb = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;

    public function getIdCamp(): ?int
    {
        return $this->idCamp;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->nbrPlace;
    }

    public function setNbrPlace(int $nbrPlace): self
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(?\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }


}
