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

    public function getIdT(): ?int
    {
        return $this->idT;
    }

    public function getNbrtPlace(): ?int
    {
        return $this->nbrtPlace;
    }

    public function setNbrtPlace(int $nbrtPlace): self
    {
        $this->nbrtPlace = $nbrtPlace;

        return $this;
    }

    public function getTypeT(): ?string
    {
        return $this->typeT;
    }

    public function setTypeT(string $typeT): self
    {
        $this->typeT = $typeT;

        return $this;
    }

    public function getDispoT(): ?bool
    {
        return $this->dispoT;
    }

    public function setDispoT(bool $dispoT): self
    {
        $this->dispoT = $dispoT;

        return $this;
    }


}
