<?php

namespace App\Entity;

use App\Repository\AfficheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AfficheRepository::class)
 */
class Affiche
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 50, 
     *      minMessage = "Veuillez entrer au minium {{ limit }} charactaire", 
     *      allowEmptyString = false
     * )
     */
    private $info;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="affiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

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
     * @ORM\OneToMany(targetEntity=AfficheFiligrame::class, mappedBy="affiche")
     */
    private $afficheFiligrames;

    /**
     * @ORM\OneToMany(targetEntity=AfficheFinale::class, mappedBy="affiche")
     */
    private $afficheFinales;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=AfficheFiligrame::class, inversedBy="affiches")
     */
    private $predefinie;

    public function __construct()
    {
        $this->afficheFiligrames = new ArrayCollection();
        $this->afficheFinales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
 

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    } 

    /**
     * @return Collection|AfficheFiligrame[]
     */
    public function getAfficheFiligrames(): Collection
    {
        return $this->afficheFiligrames;
    }

    public function addAfficheFiligrame(AfficheFiligrame $afficheFiligrame): self
    {
        if (!$this->afficheFiligrames->contains($afficheFiligrame)) {
            $this->afficheFiligrames[] = $afficheFiligrame;
            $afficheFiligrame->setAffiche($this);
        }

        return $this;
    }

    public function removeAfficheFiligrame(AfficheFiligrame $afficheFiligrame): self
    {
        if ($this->afficheFiligrames->contains($afficheFiligrame)) {
            $this->afficheFiligrames->removeElement($afficheFiligrame);
            // set the owning side to null (unless already changed)
            if ($afficheFiligrame->getAffiche() === $this) {
                $afficheFiligrame->setAffiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AfficheFinale[]
     */
    public function getAfficheFinales(): Collection
    {
        return $this->afficheFinales;
    }

    public function addAfficheFinale(AfficheFinale $afficheFinale): self
    {
        if (!$this->afficheFinales->contains($afficheFinale)) {
            $this->afficheFinales[] = $afficheFinale;
            $afficheFinale->setAffiche($this);
        }

        return $this;
    }

    public function removeAfficheFinale(AfficheFinale $afficheFinale): self
    {
        if ($this->afficheFinales->contains($afficheFinale)) {
            $this->afficheFinales->removeElement($afficheFinale);
            // set the owning side to null (unless already changed)
            if ($afficheFinale->getAffiche() === $this) {
                $afficheFinale->setAffiche(null);
            }
        }

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

    public function getPredefinie(): ?AfficheFiligrame
    {
        return $this->predefinie;
    }

    public function setPredefinie(?AfficheFiligrame $predefinie): self
    {
        $this->predefinie = $predefinie;

        return $this;
    }
}
