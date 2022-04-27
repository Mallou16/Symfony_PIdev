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
     * @ORM\Column(name="ID_Materiel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMateriel;

    /**
     * @var string
     * @Assert\NotBlank(message=" le nom doit etre non vide")
     * @Assert\Regex (pattern="/^[a-zA-Z ]+$/i")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer un titre au mini de 3 caracteres")
     * @ORM\Column(name="Nom", type="string", length=20, nullable=false)
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
     * @Assert\Positive(message="The value should be positive ")
     * @ORM\Column(name="Prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     * @Assert\NotBlank(message="etat doit etre non vide")
     * @Assert\Regex (pattern="/^[a-zA-Z ]+$/i")
     * @ORM\Column(name="Etat", type="string", length=20, nullable=false)
     */
    private $etat;

    /**
     * @var string|null
     * @Assert\NotBlank(message="description doit etre non vide")
     * @Assert\Regex (pattern="/^[a-zA-Z ]+$/i")
     * @Assert\Length(
     *      min = 7,
     *      max = 300,
     *      minMessage = "doit etre >=7 ",
     *      maxMessage = "doit etre <=300" )
     * @ORM\Column(name="Description", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message=" l'image doit etre non vide")
     * @ORM\Column(name="Image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Panier", mappedBy="idMateriel")
     */
    private $idPanier;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPanier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getIdMateriel(): int
    {
        return $this->idMateriel;
    }

    /**
     * @param int $idMateriel
     */
    public function setIdMateriel(int $idMateriel): void
    {
        $this->idMateriel = $idMateriel;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return int
     */
    public function getQuantite()
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
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat(string $etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdPanier()
    {
        return $this->idPanier;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $idPanier
     */
    public function setIdPanier($idPanier): void
    {
        $this->idPanier = $idPanier;
    }



}