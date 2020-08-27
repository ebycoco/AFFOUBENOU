<?php

namespace App\Entity;

use App\Repository\CarteMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CarteMenuRepository::class)
 */
class CarteMenu
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
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 20, 
     *      minMessage = "Veuillez entrer au minium {{ limit }} charactaire", 
     *      allowEmptyString = false
     * )
     */
    private $menus;

    /**
     * @ORM\Column(type="integer")
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="carteMenus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $quantite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $info;

    /**
     * @ORM\OneToMany(targetEntity=CarteMenuFiligramme::class, mappedBy="cartemenu")
     */
    private $carteMenuFiligrammes;

    /**
     * @ORM\ManyToOne(targetEntity=CarteMenuFiligramme::class, inversedBy="carteMenus")
     */
    private $predefinie;

    /**
     * @ORM\OneToMany(targetEntity=CarteMenuFinale::class, mappedBy="cartemenu")
     */
    private $carteMenuFinales;

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
        $this->carteMenuFiligrammes = new ArrayCollection();
        $this->carteMenuFinales = new ArrayCollection();
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

    public function getMenus(): ?string
    {
        return $this->menus;
    }

    public function setMenus(string $menus): self
    {
        $this->menus = $menus;

        return $this;
    }

    public function getContact(): ?int
    {
        return $this->contact;
    }

    public function setContact(int $contact): self
    {
        $this->contact = $contact;

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return Collection|CarteMenuFiligramme[]
     */
    public function getCarteMenuFiligrammes(): Collection
    {
        return $this->carteMenuFiligrammes;
    }

    public function addCarteMenuFiligramme(CarteMenuFiligramme $carteMenuFiligramme): self
    {
        if (!$this->carteMenuFiligrammes->contains($carteMenuFiligramme)) {
            $this->carteMenuFiligrammes[] = $carteMenuFiligramme;
            $carteMenuFiligramme->setCartemenu($this);
        }

        return $this;
    }

    public function removeCarteMenuFiligramme(CarteMenuFiligramme $carteMenuFiligramme): self
    {
        if ($this->carteMenuFiligrammes->contains($carteMenuFiligramme)) {
            $this->carteMenuFiligrammes->removeElement($carteMenuFiligramme);
            // set the owning side to null (unless already changed)
            if ($carteMenuFiligramme->getCartemenu() === $this) {
                $carteMenuFiligramme->setCartemenu(null);
            }
        }

        return $this;
    }

    public function getPredefinie(): ?CarteMenuFiligramme
    {
        return $this->predefinie;
    }

    public function setPredefinie(?CarteMenuFiligramme $predefinie): self
    {
        $this->predefinie = $predefinie;

        return $this;
    }

    /**
     * @return Collection|CarteMenuFinale[]
     */
    public function getCarteMenuFinales(): Collection
    {
        return $this->carteMenuFinales;
    }

    public function addCarteMenuFinale(CarteMenuFinale $carteMenuFinale): self
    {
        if (!$this->carteMenuFinales->contains($carteMenuFinale)) {
            $this->carteMenuFinales[] = $carteMenuFinale;
            $carteMenuFinale->setCartemenu($this);
        }

        return $this;
    }

    public function removeCarteMenuFinale(CarteMenuFinale $carteMenuFinale): self
    {
        if ($this->carteMenuFinales->contains($carteMenuFinale)) {
            $this->carteMenuFinales->removeElement($carteMenuFinale);
            // set the owning side to null (unless already changed)
            if ($carteMenuFinale->getCartemenu() === $this) {
                $carteMenuFinale->setCartemenu(null);
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
