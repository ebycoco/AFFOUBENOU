<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message="Ce champs ne pas être vide")
     */
    private $nom;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=ServicesGraphisme::class, mappedBy="categorie")
     */
    private $servicesGraphismes;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCategorie;

    public function __construct()
    {
        $this->servicesGraphismes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    } 

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return Collection|ServicesGraphisme[]
     */
    public function getServicesGraphismes(): Collection
    {
        return $this->servicesGraphismes;
    }

    public function addServicesGraphisme(ServicesGraphisme $servicesGraphisme): self
    {
        if (!$this->servicesGraphismes->contains($servicesGraphisme)) {
            $this->servicesGraphismes[] = $servicesGraphisme;
            $servicesGraphisme->setCategorie($this);
        }

        return $this;
    }

    public function removeServicesGraphisme(ServicesGraphisme $servicesGraphisme): self
    {
        if ($this->servicesGraphismes->contains($servicesGraphisme)) {
            $this->servicesGraphismes->removeElement($servicesGraphisme);
            // set the owning side to null (unless already changed)
            if ($servicesGraphisme->getCategorie() === $this) {
                $servicesGraphisme->setCategorie(null);
            }
        }

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }
}
