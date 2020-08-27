<?php

namespace App\Entity;

use App\Repository\CarteVisiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CarteVisiteRepository::class)
 * @Vich\Uploadable
 */
class CarteVisite
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
     * @Vich\UploadableField(mapping="carteVisite_client", fileNameProperty="imageName") 
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message="Ce champs ne pas être vide")
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message="Ce champs ne pas être vide")
     */
    private $nomSociete;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank (message="Ce champs ne pas être vide")
     */
    private $contact1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $contact2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addressDuSite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroFixe;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message="Ce champs ne pas être vide")
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message="Ce champs ne pas être vide")
     */
    private $social;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autresInfor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="carteVisites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=CarteVisiteFiligramme::class, mappedBy="cartevisite")
     */
    private $carteVisiteFiligrammes;

    /**
     * @ORM\OneToMany(targetEntity=CarteVisiteFinale::class, mappedBy="cartevisite")
     */
    private $carteVisiteFinales;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=CarteVisiteFiligramme::class, inversedBy="carteVisites")
     */
    private $predefinie;

    public function __construct()
    {
        $this->carteVisiteFiligrammes = new ArrayCollection();
        $this->carteVisiteFinales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getNomSociete(): ?string
    {
        return $this->nomSociete;
    }

    public function setNomSociete(string $nomSociete): self
    {
        $this->nomSociete = $nomSociete;

        return $this;
    }

    public function getContact1(): ?int
    {
        return $this->contact1;
    }

    public function setContact1(int $contact1): self
    {
        $this->contact1 = $contact1;

        return $this;
    }

    public function getContact2(): ?int
    {
        return $this->contact2;
    }

    public function setContact2(?int $contact2): self
    {
        $this->contact2 = $contact2;

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

    public function getAddressDuSite(): ?string
    {
        return $this->addressDuSite;
    }

    public function setAddressDuSite(?string $addressDuSite): self
    {
        $this->addressDuSite = $addressDuSite;

        return $this;
    }

    public function getNumeroFixe(): ?int
    {
        return $this->numeroFixe;
    }

    public function setNumeroFixe(?int $numeroFixe): self
    {
        $this->numeroFixe = $numeroFixe;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getSocial(): ?string
    {
        return $this->social;
    }

    public function setSocial(string $social): self
    {
        $this->social = $social;

        return $this;
    }

    public function getAutresInfor(): ?string
    {
        return $this->autresInfor;
    }

    public function setAutresInfor(?string $autresInfor): self
    {
        $this->autresInfor = $autresInfor;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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

    /**
     * @return Collection|CarteVisiteFiligramme[]
     */
    public function getCarteVisiteFiligrammes(): Collection
    {
        return $this->carteVisiteFiligrammes;
    }

    public function addCarteVisiteFiligramme(CarteVisiteFiligramme $carteVisiteFiligramme): self
    {
        if (!$this->carteVisiteFiligrammes->contains($carteVisiteFiligramme)) {
            $this->carteVisiteFiligrammes[] = $carteVisiteFiligramme;
            $carteVisiteFiligramme->setCartevisite($this);
        }

        return $this;
    }

    public function removeCarteVisiteFiligramme(CarteVisiteFiligramme $carteVisiteFiligramme): self
    {
        if ($this->carteVisiteFiligrammes->contains($carteVisiteFiligramme)) {
            $this->carteVisiteFiligrammes->removeElement($carteVisiteFiligramme);
            // set the owning side to null (unless already changed)
            if ($carteVisiteFiligramme->getCartevisite() === $this) {
                $carteVisiteFiligramme->setCartevisite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CarteVisiteFinale[]
     */
    public function getCarteVisiteFinales(): Collection
    {
        return $this->carteVisiteFinales;
    }

    public function addCarteVisiteFinale(CarteVisiteFinale $carteVisiteFinale): self
    {
        if (!$this->carteVisiteFinales->contains($carteVisiteFinale)) {
            $this->carteVisiteFinales[] = $carteVisiteFinale;
            $carteVisiteFinale->setCartevisite($this);
        }

        return $this;
    }

    public function removeCarteVisiteFinale(CarteVisiteFinale $carteVisiteFinale): self
    {
        if ($this->carteVisiteFinales->contains($carteVisiteFinale)) {
            $this->carteVisiteFinales->removeElement($carteVisiteFinale);
            // set the owning side to null (unless already changed)
            if ($carteVisiteFinale->getCartevisite() === $this) {
                $carteVisiteFinale->setCartevisite(null);
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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPredefinie(): ?CarteVisiteFiligramme
    {
        return $this->predefinie;
    }

    public function setPredefinie(?CarteVisiteFiligramme $predefinie): self
    {
        $this->predefinie = $predefinie;

        return $this;
    }
}
