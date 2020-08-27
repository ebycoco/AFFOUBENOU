<?php

namespace App\Entity;

use App\Repository\BadgesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=BadgesRepository::class)
 */
class Badges
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
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="badges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=BadgesFiligramme::class, mappedBy="badge")
     */
    private $badgesFiligrammes;

    /**
     * @ORM\ManyToOne(targetEntity=BadgesFiligramme::class, inversedBy="badges")
     */
    private $predefinie;

    /**
     * @ORM\OneToMany(targetEntity=BadgesFinale::class, mappedBy="badge")
     */
    private $badgesFinales;

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
        $this->badgesFiligrammes = new ArrayCollection();
        $this->badgesFinales = new ArrayCollection();
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    /**
     * @return Collection|BadgesFiligramme[]
     */
    public function getBadgesFiligrammes(): Collection
    {
        return $this->badgesFiligrammes;
    }

    public function addBadgesFiligramme(BadgesFiligramme $badgesFiligramme): self
    {
        if (!$this->badgesFiligrammes->contains($badgesFiligramme)) {
            $this->badgesFiligrammes[] = $badgesFiligramme;
            $badgesFiligramme->setBadge($this);
        }

        return $this;
    }

    public function removeBadgesFiligramme(BadgesFiligramme $badgesFiligramme): self
    {
        if ($this->badgesFiligrammes->contains($badgesFiligramme)) {
            $this->badgesFiligrammes->removeElement($badgesFiligramme);
            // set the owning side to null (unless already changed)
            if ($badgesFiligramme->getBadge() === $this) {
                $badgesFiligramme->setBadge(null);
            }
        }

        return $this;
    }

    public function getPredefinie(): ?BadgesFiligramme
    {
        return $this->predefinie;
    }

    public function setPredefinie(?BadgesFiligramme $predefinie): self
    {
        $this->predefinie = $predefinie;

        return $this;
    }

    /**
     * @return Collection|BadgesFinale[]
     */
    public function getBadgesFinales(): Collection
    {
        return $this->badgesFinales;
    }

    public function addBadgesFinale(BadgesFinale $badgesFinale): self
    {
        if (!$this->badgesFinales->contains($badgesFinale)) {
            $this->badgesFinales[] = $badgesFinale;
            $badgesFinale->setBadge($this);
        }

        return $this;
    }

    public function removeBadgesFinale(BadgesFinale $badgesFinale): self
    {
        if ($this->badgesFinales->contains($badgesFinale)) {
            $this->badgesFinales->removeElement($badgesFinale);
            // set the owning side to null (unless already changed)
            if ($badgesFinale->getBadge() === $this) {
                $badgesFinale->setBadge(null);
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
