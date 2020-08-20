<?php

namespace App\Entity;

use App\Repository\ServiceWebDemoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ServiceWebDemoRepository::class)
 * @Vich\Uploadable
 */
class ServiceWebDemo
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
     * @Vich\UploadableField(mapping="demoweb", fileNameProperty="imageName")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $imageName;

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
     * @ORM\ManyToOne(targetEntity=CommandeServicesWeb::class, inversedBy="serviceWebDemos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commandeServiceWeb;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="serviceWebDemos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=CommandeServicesWeb::class, mappedBy="demo")
     */
    private $commandeServicesWebs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lien;

    public function __construct()
    {
        $this->commandeServicesWebs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    } 

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }


    public function getCommandeServiceWeb(): ?CommandeServicesWeb
    {
        return $this->commandeServiceWeb;
    }

    public function setCommandeServiceWeb(?CommandeServicesWeb $commandeServiceWeb): self
    {
        $this->commandeServiceWeb = $commandeServiceWeb;

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
            $commandeServicesWeb->setDemo($this);
        }

        return $this;
    }

    public function removeCommandeServicesWeb(CommandeServicesWeb $commandeServicesWeb): self
    {
        if ($this->commandeServicesWebs->contains($commandeServicesWeb)) {
            $this->commandeServicesWebs->removeElement($commandeServicesWeb);
            // set the owning side to null (unless already changed)
            if ($commandeServicesWeb->getDemo() === $this) {
                $commandeServicesWeb->setDemo(null);
            }
        }

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
}
