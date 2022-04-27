<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table(name="historique")
 * @ORM\Entity
 */
class Historique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_historique", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHistorique;

    /**
     * @var int
     *
     * @ORM\Column(name="idpanier", type="integer", nullable=false)
     */
    private $idpanier;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_materiel", type="string", length=255, nullable=false)
     */
    private $nomMateriel;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="prixu", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixu;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255, nullable=false)
     */
    private $date;

    /**
     * @return int
     */
    public function getIdHistorique(): int
    {
        return $this->idHistorique;
    }

    /**
     * @param int $idHistorique
     */
    public function setIdHistorique(int $idHistorique): void
    {
        $this->idHistorique = $idHistorique;
    }

    /**
     * @return int
     */
    public function getIdpanier(): int
    {
        return $this->idpanier;
    }

    /**
     * @param int $idpanier
     */
    public function setIdpanier(int $idpanier): void
    {
        $this->idpanier = $idpanier;
    }

    /**
     * @return string
     */
    public function getNomMateriel(): string
    {
        return $this->nomMateriel;
    }

    /**
     * @param string $nomMateriel
     */
    public function setNomMateriel(string $nomMateriel): void
    {
        $this->nomMateriel = $nomMateriel;
    }

    /**
     * @return int
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite(int $quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return float
     */
    public function getPrixu(): float
    {
        return $this->prixu;
    }

    /**
     * @param float $prixu
     */
    public function setPrixu(float $prixu): void
    {
        $this->prixu = $prixu;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }



}
