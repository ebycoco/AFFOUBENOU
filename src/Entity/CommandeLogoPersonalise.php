<?php

namespace App\Entity;

use App\Repository\CommandeLogoPersonaliseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommandeLogoPersonaliseRepository::class)
 * @Vich\Uploadable
 */
class CommandeLogoPersonalise
{
    const TYPELOGO = [
        0 => 'Image',
        1 => 'La 1er lettre du nom de logo',
        2 => 'Nom complete du nom de logo ',
    ];
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
     * @Assert\Image(maxSize = "8M")
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
     * @Assert\NotBlank (message="Ce champs ne pas être vide")
     */
    private $nomLogo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleur0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleur1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleur2;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleur3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $modification;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $etat = false;

    /**
     * @ORM\Column(type="integer") 
     */
    private $typeLogo;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="commandeLogoPersonalises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message="Ce champs ne pas être vide")
     */
    private $choix;

    /**
     * @ORM\OneToMany(targetEntity=CommandePredefiniePerso::class, mappedBy="commandelogoperso")
     */
    private $commandePredefiniePersos;

    /**
     * @ORM\OneToMany(targetEntity=CommandeFinalePerso::class, mappedBy="commandelogoperso")
     */
    private $commandeFinalePersos;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $niveau;

    public function __construct()
    {
        $this->commandePredefiniePersos = new ArrayCollection();
        $this->commandeFinalePersos = new ArrayCollection();
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

    public function getCouleur0(): ?string
    {
        return $this->couleur0;
    }

    public function setCouleur0(?string $couleur0): self
    {
        $this->couleur0 = $couleur0;

        return $this;
    }
    public function getCouleur1(): ?string
    {
        return $this->couleur1;
    }

    public function setCouleur1(?string $couleur1): self
    {
        $this->couleur1 = $couleur1;

        return $this;
    }
    public function getCouleur2(): ?string
    {
        return $this->couleur2;
    }

    public function setCouleur2(?string $couleur2): self
    {
        $this->couleur2 = $couleur2;

        return $this;
    }
    public function getCouleur3(): ?string
    {
        return $this->couleur3;
    }

    public function setCouleur3(?string $couleur3): self
    {
        $this->couleur3 = $couleur3;

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

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getTypeLogo(): ?int
    {
        return $this->typeLogo;
    }

    public function setTypeLogo(int $typeLogo): self
    {
        $this->typeLogo = $typeLogo;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getChoix(): ?string
    {
        return $this->choix;
    }

    public function setChoix(string $choix): self
    {
        $this->choix = $choix;

        return $this;
    }

    /**
     * @return Collection|CommandePredefiniePerso[]
     */
    public function getCommandePredefiniePersos(): Collection
    {
        return $this->commandePredefiniePersos;
    }

    public function addCommandePredefiniePerso(CommandePredefiniePerso $commandePredefiniePerso): self
    {
        if (!$this->commandePredefiniePersos->contains($commandePredefiniePerso)) {
            $this->commandePredefiniePersos[] = $commandePredefiniePerso;
            $commandePredefiniePerso->setCommandelogoperso($this);
        }

        return $this;
    }

    public function removeCommandePredefiniePerso(CommandePredefiniePerso $commandePredefiniePerso): self
    {
        if ($this->commandePredefiniePersos->contains($commandePredefiniePerso)) {
            $this->commandePredefiniePersos->removeElement($commandePredefiniePerso);
            // set the owning side to null (unless already changed)
            if ($commandePredefiniePerso->getCommandelogoperso() === $this) {
                $commandePredefiniePerso->setCommandelogoperso(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommandeFinalePerso[]
     */
    public function getCommandeFinalePersos(): Collection
    {
        return $this->commandeFinalePersos;
    }

    public function addCommandeFinalePerso(CommandeFinalePerso $commandeFinalePerso): self
    {
        if (!$this->commandeFinalePersos->contains($commandeFinalePerso)) {
            $this->commandeFinalePersos[] = $commandeFinalePerso;
            $commandeFinalePerso->setCommandelogoperso($this);
        }

        return $this;
    }

    public function removeCommandeFinalePerso(CommandeFinalePerso $commandeFinalePerso): self
    {
        if ($this->commandeFinalePersos->contains($commandeFinalePerso)) {
            $this->commandeFinalePersos->removeElement($commandeFinalePerso);
            // set the owning side to null (unless already changed)
            if ($commandeFinalePerso->getCommandelogoperso() === $this) {
                $commandeFinalePerso->setCommandelogoperso(null);
            }
        }

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
}
