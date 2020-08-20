<?php

namespace App\Entity;

use App\Repository\CarteMenuFiligrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CarteMenuFiligrammeRepository::class)
 * @Vich\Uploadable
 */
class CarteMenuFiligramme
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
     * @Vich\UploadableField(mapping="cartemenu_filigrame", fileNameProperty="imageName")
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
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="carteMenuFiligrammes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=CarteMenu::class, inversedBy="carteMenuFiligrammes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cartemenu;

    /**
     * @ORM\OneToMany(targetEntity=CarteMenu::class, mappedBy="predefinie")
     */
    private $carteMenus;
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

    public function __construct()
    {
        $this->carteMenus = new ArrayCollection();
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

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCartemenu(): ?CarteMenu
    {
        return $this->cartemenu;
    }

    public function setCartemenu(?CarteMenu $cartemenu): self
    {
        $this->cartemenu = $cartemenu;

        return $this;
    }

    /**
     * @return Collection|CarteMenu[]
     */
    public function getCarteMenus(): Collection
    {
        return $this->carteMenus;
    }

    public function addCarteMenu(CarteMenu $carteMenu): self
    {
        if (!$this->carteMenus->contains($carteMenu)) {
            $this->carteMenus[] = $carteMenu;
            $carteMenu->setPredefinie($this);
        }

        return $this;
    }

    public function removeCarteMenu(CarteMenu $carteMenu): self
    {
        if ($this->carteMenus->contains($carteMenu)) {
            $this->carteMenus->removeElement($carteMenu);
            // set the owning side to null (unless already changed)
            if ($carteMenu->getPredefinie() === $this) {
                $carteMenu->setPredefinie(null);
            }
        }

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
}
