<?php

namespace App\Entity;

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

    public function getIdPanier(): ?int
    {
        return $this->idPanier;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }


}
