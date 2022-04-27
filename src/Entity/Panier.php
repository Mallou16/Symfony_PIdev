<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier", uniqueConstraints={@ORM\UniqueConstraint(name="ID_User", columns={"ID_User"})})
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Panier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPanier;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_User", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Materiel", inversedBy="idPanier")
     * @ORM\JoinTable(name="panierencours",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ID_Panier", referencedColumnName="ID_Panier")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ID_Materiel", referencedColumnName="ID_Materiel")
     *   }
     * )
     */
    private $idMateriel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idMateriel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdPanier(): int
    {
        return $this->idPanier;
    }

    /**
     * @param int $idPanier
     */
    public function setIdPanier(int $idPanier): void
    {
        $this->idPanier = $idPanier;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * @return Collection
     */
    public function getIdMateriel()
    {
        return $this->idMateriel;
    }

    /**
     * @param Collection $idMateriel
     */
    public function setIdMateriel($idMateriel): void
    {
        $this->idMateriel = $idMateriel;
    }


}