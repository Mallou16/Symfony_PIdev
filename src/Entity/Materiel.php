<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Materiel
 *
 * @ORM\Table(name="materiel")
 * @ORM\Entity
 */
class Materiel
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Materiel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMateriel;

    /**
     * @Assert\NotBlank(message=" le nom doit etre non vide")
     * @Assert\Regex (pattern="/^[a-zA-Z ]+$/i")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un titre au mini de 3 caracteres")
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     * @Assert\NotBlank(message="quantite doit etre non vide")
     * @Assert\Positive(message="The value should be positive")
     * @ORM\Column(name="Quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var float
     * @Assert\NotBlank(message="prix de l'unite doit etre non vide")
     * @Assert\Positive (message="The value should be positive ")
     * @ORM\Column(name="Prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @Assert\NotBlank(message="etat doit etre non vide")
     * @Assert\Regex (pattern="/^[a-zA-Z]+$/i")
     * @ORM\Column(name="Etat", type="string", length=1000)
     */
    private $etat;

    /**
     * @Assert\NotBlank(message="description doit etre non vide")
     * @Assert\Regex (pattern="/^[a-zA-Z]+$/i")
     * @Assert\Length(
     *      min = 7,
     *      max = 100,
     *      minMessage = "doit etre >=7 ",
     *      maxMessage = "doit etre <=100" )
     * @ORM\Column(name="Description", type="string", length=1000)
     */
    private $description ;

    /**
     * @var string
     * @Assert\NotBlank(message=" l'image doit etre non vide")
     * @ORM\Column(name="Image", type="string", length=255, nullable=false)
     */
    private $image;

    public function getIdMateriel(): ?int
    {
        return $this->idMateriel;
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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


}
