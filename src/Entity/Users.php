<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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

    /**
     * @ORM\OneToMany(targetEntity=CommandeLogoPersonalise::class, mappedBy="user")
     */
    private $commandeLogoPersonalises;

    /**
     * @ORM\OneToMany(targetEntity=CommandePredefiniePerso::class, mappedBy="user")
     */
    private $commandePredefiniePersos;

    /**
     * @ORM\OneToMany(targetEntity=CommandeFinalePerso::class, mappedBy="user")
     */
    private $commandeFinalePersos;

    /**
     * @ORM\OneToMany(targetEntity=CarteVisite::class, mappedBy="user")
     */
    private $carteVisites;

    /**
     * @ORM\OneToMany(targetEntity=CarteVisiteFiligramme::class, mappedBy="user")
     */
    private $carteVisiteFiligrammes;

    /**
     * @ORM\OneToMany(targetEntity=CarteVisiteFinale::class, mappedBy="user")
     */
    private $carteVisiteFinales;

    /**
     * @ORM\OneToMany(targetEntity=Affiche::class, mappedBy="user")
     */
    private $affiches;

    /**
     * @ORM\OneToMany(targetEntity=AfficheFiligrame::class, mappedBy="user")
     */
    private $afficheFiligrames;

    /**
     * @ORM\OneToMany(targetEntity=AfficheFinale::class, mappedBy="user")
     */
    private $afficheFinales;

    /**
     * @ORM\OneToMany(targetEntity=CategorieWeb::class, mappedBy="user")
     */
    private $categorieWebs;

    /**
     * @ORM\OneToMany(targetEntity=AutreFonctionnalite::class, mappedBy="user")
     */
    private $autreFonctionnalites;

    /**
     * @ORM\OneToMany(targetEntity=CommandeServicesWeb::class, mappedBy="user")
     */
    private $commandeServicesWebs;

    /**
     * @ORM\OneToMany(targetEntity=ServiceWebDemo::class, mappedBy="user")
     */
    private $serviceWebDemos;

    /**
     * @ORM\OneToMany(targetEntity=CarteMenu::class, mappedBy="user")
     */
    private $carteMenus;

    /**
     * @ORM\OneToMany(targetEntity=CarteMenuFiligramme::class, mappedBy="user")
     */
    private $carteMenuFiligrammes;

    /**
     * @ORM\OneToMany(targetEntity=CarteMenuFinale::class, mappedBy="user")
     */
    private $carteMenuFinales;

    /**
     * @ORM\OneToMany(targetEntity=Badges::class, mappedBy="user")
     */
    private $badges;

    /**
     * @ORM\OneToMany(targetEntity=BadgesFiligramme::class, mappedBy="user")
     */
    private $badgesFiligrammes;

    /**
     * @ORM\OneToMany(targetEntity=BadgesFinale::class, mappedBy="user")
     */
    private $badgesFinales;

    /**
     * @ORM\OneToMany(targetEntity=MainLogo::class, mappedBy="user")
     */
    private $mainLogos;

    /**
     * @ORM\OneToMany(targetEntity=MainCarteVisite::class, mappedBy="user")
     */
    private $mainCarteVisites;

    /**
     * @ORM\OneToMany(targetEntity=MainCarteMenu::class, mappedBy="user")
     */
    private $mainCarteMenus;

    /**
     * @ORM\OneToMany(targetEntity=MainBadge::class, mappedBy="user")
     */
    private $mainBadges;

    /**
     * @ORM\OneToMany(targetEntity=MainAffiche::class, mappedBy="user")
     */
    private $mainAffiches;

    /**
     * @ORM\OneToMany(targetEntity=MainTemplateSite::class, mappedBy="user")
     */
    private $mainTemplateSites;
 

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
        $this->commandeLogoPersonalises = new ArrayCollection();
        $this->commandePredefiniePersos = new ArrayCollection();
        $this->commandeFinalePersos = new ArrayCollection();
        $this->carteVisites = new ArrayCollection();
        $this->carteVisiteFiligrammes = new ArrayCollection();
        $this->carteVisiteFinales = new ArrayCollection();
        $this->affiches = new ArrayCollection();
        $this->afficheFiligrames = new ArrayCollection();
        $this->afficheFinales = new ArrayCollection();
        $this->categorieWebs = new ArrayCollection();
        $this->autreFonctionnalites = new ArrayCollection();
        $this->commandeServicesWebs = new ArrayCollection();
        $this->serviceWebDemos = new ArrayCollection();
        $this->carteMenus = new ArrayCollection();
        $this->carteMenuFiligrammes = new ArrayCollection();
        $this->carteMenuFinales = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->badgesFiligrammes = new ArrayCollection();
        $this->badgesFinales = new ArrayCollection();
        $this->mainLogos = new ArrayCollection();
        $this->mainCarteVisites = new ArrayCollection();
        $this->mainCarteMenus = new ArrayCollection();
        $this->mainBadges = new ArrayCollection();
        $this->mainAffiches = new ArrayCollection();
        $this->mainTemplateSites = new ArrayCollection(); 
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

    /**
     * @return Collection|CommandeLogoPersonalise[]
     */
    public function getCommandeLogoPersonalises(): Collection
    {
        return $this->commandeLogoPersonalises;
    }

    public function addCommandeLogoPersonalise(CommandeLogoPersonalise $commandeLogoPersonalise): self
    {
        if (!$this->commandeLogoPersonalises->contains($commandeLogoPersonalise)) {
            $this->commandeLogoPersonalises[] = $commandeLogoPersonalise;
            $commandeLogoPersonalise->setUser($this);
        }

        return $this;
    }

    public function removeCommandeLogoPersonalise(CommandeLogoPersonalise $commandeLogoPersonalise): self
    {
        if ($this->commandeLogoPersonalises->contains($commandeLogoPersonalise)) {
            $this->commandeLogoPersonalises->removeElement($commandeLogoPersonalise);
            // set the owning side to null (unless already changed)
            if ($commandeLogoPersonalise->getUser() === $this) {
                $commandeLogoPersonalise->setUser(null);
            }
        }

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
            $commandePredefiniePerso->setUser($this);
        }

        return $this;
    }

    public function removeCommandePredefiniePerso(CommandePredefiniePerso $commandePredefiniePerso): self
    {
        if ($this->commandePredefiniePersos->contains($commandePredefiniePerso)) {
            $this->commandePredefiniePersos->removeElement($commandePredefiniePerso);
            // set the owning side to null (unless already changed)
            if ($commandePredefiniePerso->getUser() === $this) {
                $commandePredefiniePerso->setUser(null);
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
            $commandeFinalePerso->setUser($this);
        }

        return $this;
    }

    public function removeCommandeFinalePerso(CommandeFinalePerso $commandeFinalePerso): self
    {
        if ($this->commandeFinalePersos->contains($commandeFinalePerso)) {
            $this->commandeFinalePersos->removeElement($commandeFinalePerso);
            // set the owning side to null (unless already changed)
            if ($commandeFinalePerso->getUser() === $this) {
                $commandeFinalePerso->setUser(null);
            }
        }

        return $this;
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
            $carteVisite->setUser($this);
        }

        return $this;
    }

    public function removeCarteVisite(CarteVisite $carteVisite): self
    {
        if ($this->carteVisites->contains($carteVisite)) {
            $this->carteVisites->removeElement($carteVisite);
            // set the owning side to null (unless already changed)
            if ($carteVisite->getUser() === $this) {
                $carteVisite->setUser(null);
            }
        }

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
            $carteVisiteFiligramme->setUser($this);
        }

        return $this;
    }

    public function removeCarteVisiteFiligramme(CarteVisiteFiligramme $carteVisiteFiligramme): self
    {
        if ($this->carteVisiteFiligrammes->contains($carteVisiteFiligramme)) {
            $this->carteVisiteFiligrammes->removeElement($carteVisiteFiligramme);
            // set the owning side to null (unless already changed)
            if ($carteVisiteFiligramme->getUser() === $this) {
                $carteVisiteFiligramme->setUser(null);
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
            $carteVisiteFinale->setUser($this);
        }

        return $this;
    }

    public function removeCarteVisiteFinale(CarteVisiteFinale $carteVisiteFinale): self
    {
        if ($this->carteVisiteFinales->contains($carteVisiteFinale)) {
            $this->carteVisiteFinales->removeElement($carteVisiteFinale);
            // set the owning side to null (unless already changed)
            if ($carteVisiteFinale->getUser() === $this) {
                $carteVisiteFinale->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Affiche[]
     */
    public function getAffiches(): Collection
    {
        return $this->affiches;
    }

    public function addAffich(Affiche $affich): self
    {
        if (!$this->affiches->contains($affich)) {
            $this->affiches[] = $affich;
            $affich->setUser($this);
        }

        return $this;
    }

    public function removeAffich(Affiche $affich): self
    {
        if ($this->affiches->contains($affich)) {
            $this->affiches->removeElement($affich);
            // set the owning side to null (unless already changed)
            if ($affich->getUser() === $this) {
                $affich->setUser(null);
            }
        }

        return $this;
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
            $afficheFiligrame->setUser($this);
        }

        return $this;
    }

    public function removeAfficheFiligrame(AfficheFiligrame $afficheFiligrame): self
    {
        if ($this->afficheFiligrames->contains($afficheFiligrame)) {
            $this->afficheFiligrames->removeElement($afficheFiligrame);
            // set the owning side to null (unless already changed)
            if ($afficheFiligrame->getUser() === $this) {
                $afficheFiligrame->setUser(null);
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
            $afficheFinale->setUser($this);
        }

        return $this;
    }

    public function removeAfficheFinale(AfficheFinale $afficheFinale): self
    {
        if ($this->afficheFinales->contains($afficheFinale)) {
            $this->afficheFinales->removeElement($afficheFinale);
            // set the owning side to null (unless already changed)
            if ($afficheFinale->getUser() === $this) {
                $afficheFinale->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategorieWeb[]
     */
    public function getCategorieWebs(): Collection
    {
        return $this->categorieWebs;
    }

    public function addCategorieWeb(CategorieWeb $categorieWeb): self
    {
        if (!$this->categorieWebs->contains($categorieWeb)) {
            $this->categorieWebs[] = $categorieWeb;
            $categorieWeb->setUser($this);
        }

        return $this;
    }

    public function removeCategorieWeb(CategorieWeb $categorieWeb): self
    {
        if ($this->categorieWebs->contains($categorieWeb)) {
            $this->categorieWebs->removeElement($categorieWeb);
            // set the owning side to null (unless already changed)
            if ($categorieWeb->getUser() === $this) {
                $categorieWeb->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AutreFonctionnalite[]
     */
    public function getAutreFonctionnalites(): Collection
    {
        return $this->autreFonctionnalites;
    }

    public function addAutreFonctionnalite(AutreFonctionnalite $autreFonctionnalite): self
    {
        if (!$this->autreFonctionnalites->contains($autreFonctionnalite)) {
            $this->autreFonctionnalites[] = $autreFonctionnalite;
            $autreFonctionnalite->setUser($this);
        }

        return $this;
    }

    public function removeAutreFonctionnalite(AutreFonctionnalite $autreFonctionnalite): self
    {
        if ($this->autreFonctionnalites->contains($autreFonctionnalite)) {
            $this->autreFonctionnalites->removeElement($autreFonctionnalite);
            // set the owning side to null (unless already changed)
            if ($autreFonctionnalite->getUser() === $this) {
                $autreFonctionnalite->setUser(null);
            }
        }

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
            $commandeServicesWeb->setUser($this);
        }

        return $this;
    }

    public function removeCommandeServicesWeb(CommandeServicesWeb $commandeServicesWeb): self
    {
        if ($this->commandeServicesWebs->contains($commandeServicesWeb)) {
            $this->commandeServicesWebs->removeElement($commandeServicesWeb);
            // set the owning side to null (unless already changed)
            if ($commandeServicesWeb->getUser() === $this) {
                $commandeServicesWeb->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ServiceWebDemo[]
     */
    public function getServiceWebDemos(): Collection
    {
        return $this->serviceWebDemos;
    }

    public function addServiceWebDemo(ServiceWebDemo $serviceWebDemo): self
    {
        if (!$this->serviceWebDemos->contains($serviceWebDemo)) {
            $this->serviceWebDemos[] = $serviceWebDemo;
            $serviceWebDemo->setUser($this);
        }

        return $this;
    }

    public function removeServiceWebDemo(ServiceWebDemo $serviceWebDemo): self
    {
        if ($this->serviceWebDemos->contains($serviceWebDemo)) {
            $this->serviceWebDemos->removeElement($serviceWebDemo);
            // set the owning side to null (unless already changed)
            if ($serviceWebDemo->getUser() === $this) {
                $serviceWebDemo->setUser(null);
            }
        }

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
            $carteMenu->setUser($this);
        }

        return $this;
    }

    public function removeCarteMenu(CarteMenu $carteMenu): self
    {
        if ($this->carteMenus->contains($carteMenu)) {
            $this->carteMenus->removeElement($carteMenu);
            // set the owning side to null (unless already changed)
            if ($carteMenu->getUser() === $this) {
                $carteMenu->setUser(null);
            }
        }

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
            $carteMenuFiligramme->setUser($this);
        }

        return $this;
    }

    public function removeCarteMenuFiligramme(CarteMenuFiligramme $carteMenuFiligramme): self
    {
        if ($this->carteMenuFiligrammes->contains($carteMenuFiligramme)) {
            $this->carteMenuFiligrammes->removeElement($carteMenuFiligramme);
            // set the owning side to null (unless already changed)
            if ($carteMenuFiligramme->getUser() === $this) {
                $carteMenuFiligramme->setUser(null);
            }
        }

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
            $carteMenuFinale->setUser($this);
        }

        return $this;
    }

    public function removeCarteMenuFinale(CarteMenuFinale $carteMenuFinale): self
    {
        if ($this->carteMenuFinales->contains($carteMenuFinale)) {
            $this->carteMenuFinales->removeElement($carteMenuFinale);
            // set the owning side to null (unless already changed)
            if ($carteMenuFinale->getUser() === $this) {
                $carteMenuFinale->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Badges[]
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badges $badge): self
    {
        if (!$this->badges->contains($badge)) {
            $this->badges[] = $badge;
            $badge->setUser($this);
        }

        return $this;
    }

    public function removeBadge(Badges $badge): self
    {
        if ($this->badges->contains($badge)) {
            $this->badges->removeElement($badge);
            // set the owning side to null (unless already changed)
            if ($badge->getUser() === $this) {
                $badge->setUser(null);
            }
        }

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
            $badgesFiligramme->setUser($this);
        }

        return $this;
    }

    public function removeBadgesFiligramme(BadgesFiligramme $badgesFiligramme): self
    {
        if ($this->badgesFiligrammes->contains($badgesFiligramme)) {
            $this->badgesFiligrammes->removeElement($badgesFiligramme);
            // set the owning side to null (unless already changed)
            if ($badgesFiligramme->getUser() === $this) {
                $badgesFiligramme->setUser(null);
            }
        }

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
            $badgesFinale->setUser($this);
        }

        return $this;
    }

    public function removeBadgesFinale(BadgesFinale $badgesFinale): self
    {
        if ($this->badgesFinales->contains($badgesFinale)) {
            $this->badgesFinales->removeElement($badgesFinale);
            // set the owning side to null (unless already changed)
            if ($badgesFinale->getUser() === $this) {
                $badgesFinale->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MainLogo[]
     */
    public function getMainLogos(): Collection
    {
        return $this->mainLogos;
    }

    public function addMainLogo(MainLogo $mainLogo): self
    {
        if (!$this->mainLogos->contains($mainLogo)) {
            $this->mainLogos[] = $mainLogo;
            $mainLogo->setUser($this);
        }

        return $this;
    }

    public function removeMainLogo(MainLogo $mainLogo): self
    {
        if ($this->mainLogos->contains($mainLogo)) {
            $this->mainLogos->removeElement($mainLogo);
            // set the owning side to null (unless already changed)
            if ($mainLogo->getUser() === $this) {
                $mainLogo->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MainCarteVisite[]
     */
    public function getMainCarteVisites(): Collection
    {
        return $this->mainCarteVisites;
    }

    public function addMainCarteVisite(MainCarteVisite $mainCarteVisite): self
    {
        if (!$this->mainCarteVisites->contains($mainCarteVisite)) {
            $this->mainCarteVisites[] = $mainCarteVisite;
            $mainCarteVisite->setUser($this);
        }

        return $this;
    }

    public function removeMainCarteVisite(MainCarteVisite $mainCarteVisite): self
    {
        if ($this->mainCarteVisites->contains($mainCarteVisite)) {
            $this->mainCarteVisites->removeElement($mainCarteVisite);
            // set the owning side to null (unless already changed)
            if ($mainCarteVisite->getUser() === $this) {
                $mainCarteVisite->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MainCarteMenu[]
     */
    public function getMainCarteMenus(): Collection
    {
        return $this->mainCarteMenus;
    }

    public function addMainCarteMenu(MainCarteMenu $mainCarteMenu): self
    {
        if (!$this->mainCarteMenus->contains($mainCarteMenu)) {
            $this->mainCarteMenus[] = $mainCarteMenu;
            $mainCarteMenu->setUser($this);
        }

        return $this;
    }

    public function removeMainCarteMenu(MainCarteMenu $mainCarteMenu): self
    {
        if ($this->mainCarteMenus->contains($mainCarteMenu)) {
            $this->mainCarteMenus->removeElement($mainCarteMenu);
            // set the owning side to null (unless already changed)
            if ($mainCarteMenu->getUser() === $this) {
                $mainCarteMenu->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MainBadge[]
     */
    public function getMainBadges(): Collection
    {
        return $this->mainBadges;
    }

    public function addMainBadge(MainBadge $mainBadge): self
    {
        if (!$this->mainBadges->contains($mainBadge)) {
            $this->mainBadges[] = $mainBadge;
            $mainBadge->setUser($this);
        }

        return $this;
    }

    public function removeMainBadge(MainBadge $mainBadge): self
    {
        if ($this->mainBadges->contains($mainBadge)) {
            $this->mainBadges->removeElement($mainBadge);
            // set the owning side to null (unless already changed)
            if ($mainBadge->getUser() === $this) {
                $mainBadge->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MainAffiche[]
     */
    public function getMainAffiches(): Collection
    {
        return $this->mainAffiches;
    }

    public function addMainAffich(MainAffiche $mainAffich): self
    {
        if (!$this->mainAffiches->contains($mainAffich)) {
            $this->mainAffiches[] = $mainAffich;
            $mainAffich->setUser($this);
        }

        return $this;
    }

    public function removeMainAffich(MainAffiche $mainAffich): self
    {
        if ($this->mainAffiches->contains($mainAffich)) {
            $this->mainAffiches->removeElement($mainAffich);
            // set the owning side to null (unless already changed)
            if ($mainAffich->getUser() === $this) {
                $mainAffich->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MainTemplateSite[]
     */
    public function getMainTemplateSites(): Collection
    {
        return $this->mainTemplateSites;
    }

    public function addMainTemplateSite(MainTemplateSite $mainTemplateSite): self
    {
        if (!$this->mainTemplateSites->contains($mainTemplateSite)) {
            $this->mainTemplateSites[] = $mainTemplateSite;
            $mainTemplateSite->setUser($this);
        }

        return $this;
    }

    public function removeMainTemplateSite(MainTemplateSite $mainTemplateSite): self
    {
        if ($this->mainTemplateSites->contains($mainTemplateSite)) {
            $this->mainTemplateSites->removeElement($mainTemplateSite);
            // set the owning side to null (unless already changed)
            if ($mainTemplateSite->getUser() === $this) {
                $mainTemplateSite->setUser(null);
            }
        }

        return $this;
    }
   

}
