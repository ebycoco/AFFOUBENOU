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

}
