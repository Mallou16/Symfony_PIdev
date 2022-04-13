<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=SponsorRepository::class)
 */
class Sponsor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(min=3)
     * @Assert\NotBlank(message="Veuillez saisir le nom !")
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity=Publicite::class, mappedBy="category")
     */
    private $products;

    /**
     * @ORM\Column(name="adresse", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *  @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Email(message ="The email '{{ value }}' is not a valid email.")
     */
    private $email;

    /**
     * @ORM\Column(type="string",length=8 nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Length(min=2,max = 10,minMessage="le nom de recompense doit contenir au minimum {{ 2 }} caracteres",maxMessage="le nom de recompense doit contenir au plus {{ 10 }} caracteres")

     */
    private $numtel;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

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



    /**
     * @return Collection|Publicite[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Publicite $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Publicite $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumtel(): ?string
    {
        return $this->numtel;
    }

    public function setNumtel(?string $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

}
