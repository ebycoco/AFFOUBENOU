<?php

namespace App\Entity;

use App\Repository\CarteVisiteFiligrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CarteVisiteFiligrammeRepository::class)
 * @Vich\Uploadable
 */
class CarteVisiteFiligramme
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
     * @Vich\UploadableField(mapping="carteVisite_filigra", fileNameProperty="imageName")
     * @Assert\NotNull(message="Veuillez mettre une image")
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
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="carteVisiteFiligrammes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=CarteVisite::class, inversedBy="carteVisiteFiligrammes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cartevisite;

    /**
     * @ORM\OneToMany(targetEntity=CarteVisite::class, mappedBy="predefinie")
     */
    private $carteVisites;

    public function __construct()
    {
        $this->carteVisites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCartevisite(): ?CarteVisite
    {
        return $this->cartevisite;
    }

    public function setCartevisite(?CarteVisite $cartevisite): self
    {
        $this->cartevisite = $cartevisite;

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

    /**
     * @return Collection|CarteVisite[]
     */
    public function getCarteVisites(): Collection
    {
        return $this->carteVisites;
    }

    public function addCarteVisite(CarteVisite $carteVisite): self
    {
        if (!$this->carteVisites->contains($carteVisite)) {
            $this->carteVisites[] = $carteVisite;
            $carteVisite->setPredefinie($this);
        }

        return $this;
    }

    public function removeCarteVisite(CarteVisite $carteVisite): self
    {
        if ($this->carteVisites->contains($carteVisite)) {
            $this->carteVisites->removeElement($carteVisite);
            // set the owning side to null (unless already changed)
            if ($carteVisite->getPredefinie() === $this) {
                $carteVisite->setPredefinie(null);
            }
        }

        return $this;
    }
}
