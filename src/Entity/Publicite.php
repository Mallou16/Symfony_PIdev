<?php

namespace App\Entity;

use App\Repository\PubliciteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PubliciteRepository::class)
 */
class Publicite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;



    /**
     * @ORM\Column(type="float")
     * @Assert\NotEqualTo(
     *  value=0
     * )
     * @Assert\NotBlank(message="Veuillez saisir le prix !")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Sponsor::class, inversedBy="products")
     */
    private $category;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }



    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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
    public function __toString()
    {
        return $this->name;
    }

    public function getCategory(): ?Sponsor
    {
        return $this->category;
    }

    public function setCategory(?Sponsor $category): self
    {
        $this->category = $category;

        return $this;
    }


}
