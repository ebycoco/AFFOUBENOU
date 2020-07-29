<?php

namespace App\Entity;

use App\Repository\CommandeLogoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CommandeLogoRepository::class)
 * @Vich\Uploadable
 */
class CommandeLogo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="logo_Graph_client", fileNameProperty="imageName")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string|null
     */
    private $imageName;
    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime"), nullable=true
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLogo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $modification;

    /**
     * @ORM\ManyToOne(targetEntity=ServicesGraphisme::class, inversedBy="commandeLogos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $servicesGraphisme;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="commandeLogos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $etat=false;

    /**
     * @ORM\OneToMany(targetEntity=CommandePredefine::class, mappedBy="commandelogo")
     */
    private $commandePredefines;

    /**
     * @ORM\ManyToOne(targetEntity=CommandePredefine::class, inversedBy="commandeLogos")
     */
    private $predefinie;
 

    public function __construct()
    {
        $this->commandePredefines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLogo(): ?string
    {
        return $this->nomLogo;
    }

    public function setNomLogo(string $nomLogo): self
    {
        $this->nomLogo = $nomLogo;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getModification(): ?string
    {
        return $this->modification;
    }

    public function setModification(?string $modification): self
    {
        $this->modification = $modification;

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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getServicesGraphisme(): ?ServicesGraphisme
    {
        return $this->servicesGraphisme;
    }

    public function setServicesGraphisme(?ServicesGraphisme $servicesGraphisme): self
    {
        $this->servicesGraphisme = $servicesGraphisme;

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

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|CommandePredefine[]
     */
    public function getCommandePredefines(): Collection
    {
        return $this->commandePredefines;
    }

    public function addCommandePredefine(CommandePredefine $commandePredefine): self
    {
        if (!$this->commandePredefines->contains($commandePredefine)) {
            $this->commandePredefines[] = $commandePredefine;
            $commandePredefine->setCommandelogo($this);
        }

        return $this;
    }

    public function removeCommandePredefine(CommandePredefine $commandePredefine): self
    {
        if ($this->commandePredefines->contains($commandePredefine)) {
            $this->commandePredefines->removeElement($commandePredefine);
            // set the owning side to null (unless already changed)
            if ($commandePredefine->getCommandelogo() === $this) {
                $commandePredefine->setCommandelogo(null);
            }
        }

        return $this;
    }

    public function getPredefinie(): ?CommandePredefine
    {
        return $this->predefinie;
    }

    public function setPredefinie(?CommandePredefine $predefinie): self
    {
        $this->predefinie = $predefinie;

        return $this;
    }

}
