<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panierencours
 *
 * @ORM\Table(name="panierencours", indexes={@ORM\Index(name="FK_Materiel", columns={"ID_Materiel"})})
 * @ORM\Entity
 */
class Panierencours
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Panier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idPanier;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_Materiel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idMateriel;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_p", type="integer", nullable=false)
     */
    private $quantiteP;

    public function getIdPanier(): ?int
    {
        return $this->idPanier;
    }

    public function getIdMateriel(): ?int
    {
        return $this->idMateriel;
    }

    public function getQuantiteP(): ?int
    {
        return $this->quantiteP;
    }

    public function setQuantiteP(int $quantiteP): self
    {
        $this->quantiteP = $quantiteP;

        return $this;
    }


}
