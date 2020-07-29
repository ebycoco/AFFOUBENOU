<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface
{
    const SEXE = [
        0 => 'Homme',
        1 => 'Femme'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Sliders::class, mappedBy="user")
     */
    private $sliders;

    /**
     * @ORM\OneToMany(targetEntity=Slogan::class, mappedBy="user")
     */
    private $slogans;

    /**
     * @ORM\OneToMany(targetEntity=Services::class, mappedBy="user")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=Equipes::class, mappedBy="user")
     */
    private $equipes;

    /**
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="user")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=Offres::class, mappedBy="user")
     */
    private $offres;

    /**
     * @ORM\OneToMany(targetEntity=ServiceWeb::class, mappedBy="user")
     */
    private $serviceWebs;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="user")
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity=Articles::class, mappedBy="favoris")
     */
    private $favoris;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroTel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=ServicesGraphisme::class, mappedBy="user")
     */
    private $servicesGraphismes;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="user")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=CommandeLogo::class, mappedBy="user")
     */
    private $commandeLogos;

    /**
     * @ORM\OneToMany(targetEntity=CommandePredefine::class, mappedBy="user")
     */
    private $commandePredefines;

    public function __construct()
    {
        $this->sliders = new ArrayCollection();
        $this->slogans = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->equipes = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->offres = new ArrayCollection();
        $this->serviceWebs = new ArrayCollection();
        $this->favoris = new ArrayCollection();
        $this->servicesGraphismes = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->commandeLogos = new ArrayCollection();
        $this->commandePredefines = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection|Sliders[]
     */
    public function getSliders(): Collection
    {
        return $this->sliders;
    }

    public function addSlider(Sliders $slider): self
    {
        if (!$this->sliders->contains($slider)) {
            $this->sliders[] = $slider;
            $slider->setUser($this);
        }

        return $this;
    }

    public function removeSlider(Sliders $slider): self
    {
        if ($this->sliders->contains($slider)) {
            $this->sliders->removeElement($slider);
            // set the owning side to null (unless already changed)
            if ($slider->getUser() === $this) {
                $slider->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Slogan[]
     */
    public function getSlogans(): Collection
    {
        return $this->slogans;
    }

    public function addSlogan(Slogan $slogan): self
    {
        if (!$this->slogans->contains($slogan)) {
            $this->slogans[] = $slogan;
            $slogan->setUser($this);
        }

        return $this;
    }

    public function removeSlogan(Slogan $slogan): self
    {
        if ($this->slogans->contains($slogan)) {
            $this->slogans->removeElement($slogan);
            // set the owning side to null (unless already changed)
            if ($slogan->getUser() === $this) {
                $slogan->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setUser($this);
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            // set the owning side to null (unless already changed)
            if ($service->getUser() === $this) {
                $service->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Equipes[]
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipes $equipe): self
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes[] = $equipe;
            $equipe->setUser($this);
        }

        return $this;
    }

    public function removeEquipe(Equipes $equipe): self
    {
        if ($this->equipes->contains($equipe)) {
            $this->equipes->removeElement($equipe);
            // set the owning side to null (unless already changed)
            if ($equipe->getUser() === $this) {
                $equipe->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    } 

    /**
     * @return Collection|Offres[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offres $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setUser($this);
        }

        return $this;
    }

    public function removeOffre(Offres $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getUser() === $this) {
                $offre->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ServiceWeb[]
     */
    public function getServiceWebs(): Collection
    {
        return $this->serviceWebs;
    }

    public function addServiceWeb(ServiceWeb $serviceWeb): self
    {
        if (!$this->serviceWebs->contains($serviceWeb)) {
            $this->serviceWebs[] = $serviceWeb;
            $serviceWeb->setUser($this);
        }

        return $this;
    }

    public function removeServiceWeb(ServiceWeb $serviceWeb): self
    {
        if ($this->serviceWebs->contains($serviceWeb)) {
            $this->serviceWebs->removeElement($serviceWeb);
            // set the owning side to null (unless already changed)
            if ($serviceWeb->getUser() === $this) {
                $serviceWeb->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getUser() === $this) {
                $commentaire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Articles $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->addFavori($this);
        }

        return $this;
    }

    public function removeFavori(Articles $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            $favori->removeFavori($this);
        }

        return $this;
    }

    public function getNumeroTel(): ?int
    {
        return $this->numeroTel;
    }

    public function setNumeroTel(?int $numeroTel): self
    {
        $this->numeroTel = $numeroTel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|ServicesGraphisme[]
     */
    public function getServicesGraphismes(): Collection
    {
        return $this->servicesGraphismes;
    }

    public function addServicesGraphisme(ServicesGraphisme $servicesGraphisme): self
    {
        if (!$this->servicesGraphismes->contains($servicesGraphisme)) {
            $this->servicesGraphismes[] = $servicesGraphisme;
            $servicesGraphisme->setUser($this);
        }

        return $this;
    }

    public function removeServicesGraphisme(ServicesGraphisme $servicesGraphisme): self
    {
        if ($this->servicesGraphismes->contains($servicesGraphisme)) {
            $this->servicesGraphismes->removeElement($servicesGraphisme);
            // set the owning side to null (unless already changed)
            if ($servicesGraphisme->getUser() === $this) {
                $servicesGraphisme->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setUser($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getUser() === $this) {
                $category->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommandeLogo[]
     */
    public function getCommandeLogos(): Collection
    {
        return $this->commandeLogos;
    }

    public function addCommandeLogo(CommandeLogo $commandeLogo): self
    {
        if (!$this->commandeLogos->contains($commandeLogo)) {
            $this->commandeLogos[] = $commandeLogo;
            $commandeLogo->setUser($this);
        }

        return $this;
    }

    public function removeCommandeLogo(CommandeLogo $commandeLogo): self
    {
        if ($this->commandeLogos->contains($commandeLogo)) {
            $this->commandeLogos->removeElement($commandeLogo);
            // set the owning side to null (unless already changed)
            if ($commandeLogo->getUser() === $this) {
                $commandeLogo->setUser(null);
            }
        }

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
            $commandePredefine->setUser($this);
        }

        return $this;
    }

    public function removeCommandePredefine(CommandePredefine $commandePredefine): self
    {
        if ($this->commandePredefines->contains($commandePredefine)) {
            $this->commandePredefines->removeElement($commandePredefine);
            // set the owning side to null (unless already changed)
            if ($commandePredefine->getUser() === $this) {
                $commandePredefine->setUser(null);
            }
        }

        return $this;
    }

}
