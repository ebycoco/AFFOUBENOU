<?php

namespace App\Entity;

use App\Repository\CommandeServicesWebRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommandeServicesWebRepository::class)
 */
class CommandeServicesWeb
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
    private $nomEntreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomSite;  

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $social4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lien;
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
     * @ORM\ManyToOne(targetEntity=CategorieWeb::class, inversedBy="commandeServicesWebs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorieWeb;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="commandeServicesWebs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=ServiceWebDemo::class, mappedBy="commandeServiceWeb")
     */
    private $serviceWebDemos;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detail;

    /**
     * @ORM\ManyToOne(targetEntity=ServiceWebDemo::class, inversedBy="commandeServicesWebs")
     */
    private $demo;

    public function __construct()
    { 
        $this->serviceWebDemos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): self
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    public function getNomSite(): ?string
    {
        return $this->nomSite;
    }

    public function setNomSite(string $nomSite): self
    {
        $this->nomSite = $nomSite;

        return $this;
    }

 

    public function getSocial1(): ?string
    {
        return $this->social1;
    }

    public function setSocial1(?string $social1): self
    {
        $this->social1 = $social1;

        return $this;
    }

    public function getSocial2(): ?string
    {
        return $this->social2;
    }

    public function setSocial2(?string $social2): self
    {
        $this->social2 = $social2;

        return $this;
    }

    public function getSocial3(): ?string
    {
        return $this->social3;
    }

    public function setSocial3(?string $social3): self
    {
        $this->social3 = $social3;

        return $this;
    }

    public function getSocial4(): ?string
    {
        return $this->social4;
    }

    public function setSocial4(?string $social4): self
    {
        $this->social4 = $social4;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

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

    public function getCategorieWeb(): ?CategorieWeb
    {
        return $this->categorieWeb;
    }

    public function setCategorieWeb(?CategorieWeb $categorieWeb): self
    {
        $this->categorieWeb = $categorieWeb;

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

    /**
     * @return Collection|ServiceWebDemo[]
     */
    public function getServiceWebDemos(): Collection
    {
        return $this->serviceWebDemos;
    }

    public function addServiceWebDemo(ServiceWebDemo $serviceWebDemo): self
    {
        if (!$this->serviceWebDemos->contains($serviceWebDemo)) {
            $this->serviceWebDemos[] = $serviceWebDemo;
            $serviceWebDemo->setCommandeServiceWeb($this);
        }

        return $this;
    }

    public function removeServiceWebDemo(ServiceWebDemo $serviceWebDemo): self
    {
        if ($this->serviceWebDemos->contains($serviceWebDemo)) {
            $this->serviceWebDemos->removeElement($serviceWebDemo);
            // set the owning side to null (unless already changed)
            if ($serviceWebDemo->getCommandeServiceWeb() === $this) {
                $serviceWebDemo->setCommandeServiceWeb(null);
            }
        }

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getDemo(): ?ServiceWebDemo
    {
        return $this->demo;
    }

    public function setDemo(?ServiceWebDemo $demo): self
    {
        $this->demo = $demo;

        return $this;
    }
}
