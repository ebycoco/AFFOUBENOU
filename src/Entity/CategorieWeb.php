<?php

namespace App\Entity;

use App\Repository\CategorieWebRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategorieWebRepository::class)
 */
class CategorieWeb
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="categorieWebs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=CommandeServicesWeb::class, mappedBy="categorieWeb")
     */
    private $commandeServicesWebs;

    public function __construct()
    {
        $this->commandeServicesWebs = new ArrayCollection();
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

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|CommandeServicesWeb[]
     */
    public function getCommandeServicesWebs(): Collection
    {
        return $this->commandeServicesWebs;
    }

    public function addCommandeServicesWeb(CommandeServicesWeb $commandeServicesWeb): self
    {
        if (!$this->commandeServicesWebs->contains($commandeServicesWeb)) {
            $this->commandeServicesWebs[] = $commandeServicesWeb;
            $commandeServicesWeb->setCategorieWeb($this);
        }

        return $this;
    }

    public function removeCommandeServicesWeb(CommandeServicesWeb $commandeServicesWeb): self
    {
        if ($this->commandeServicesWebs->contains($commandeServicesWeb)) {
            $this->commandeServicesWebs->removeElement($commandeServicesWeb);
            // set the owning side to null (unless already changed)
            if ($commandeServicesWeb->getCategorieWeb() === $this) {
                $commandeServicesWeb->setCategorieWeb(null);
            }
        }

        return $this;
    }
}
