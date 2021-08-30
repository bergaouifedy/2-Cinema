<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnnoncesRepository::class)
 */
class Annonces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Ref;

    /**
     * @ORM\Column(type="float")
     */
    private $Prix;

    /**
     * @ORM\Column(type="string")
     */
    private $Titre;

    /**
     * @ORM\Column(type="string")
     */
    private $Type;

     /**
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;


      /**
     * @ORM\Column(type="string")
     */
    private $Image;

    /**
     * @Assert\DateTime()
     * @ORM\Column(type="datetime")
     */
    private $DateAjout;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="text")
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $Surface;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $CodePostal;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $NbrChambres;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrEtages;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Garage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Parking;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Status;

      /**
     * @var string
     *
     * @ORM\Column(name="typeTarification", type="string", length=255)
     */
    private $typeTarification;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

     /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="App\Entity\categorie")
     * @ORM\JoinTable(name="ltour_categorie_annonce")
     */
   private $categorie;








    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="annonces",cascade={"all"})
     */
    private $medias;

    /**
     * @ORM\OneToMany(targetEntity=Favori::class, mappedBy="annonce")
     */
    private $favoris;

    

    public function __construct()
    {
        $this->categorie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->favoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(User $User): self
    {
        $this->User= $User;
        return $this;
    }
    
      /**
     * Set typeTarification
     *
     * @param string $typeTarification
     *
     * @return Annonce
     */
    public function setTypeTarification($typeTarification)
    {
        $this->typeTarification = $typeTarification;

        return $this;
    }

    /**
     * Get typeTarification
     *
     * @return string
     */
    public function getTypeTarification()
    {
        return $this->typeTarification;
    }

       

    public function getRef(): ?int
    {
        return $this->Ref;
    }

    public function setRef(int $Ref): self
    {
        $this->Ref= $Ref;
        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre= $Titre;
        return $this;
    }


    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image= $Image;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type= $Type;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(String $Description): self
    {
        $this->Description= $Description;
        return $this;
    }
    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(String $Adresse): self
    {
        $this->Adresse= $Adresse;
        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix= $Prix;
        return $this;
    }

    public function getDate_Ajout(): ?DateTime
    {
        return $this->DateAjout;
    }

    public function setDate_Ajout(DateTime $DateAjout): self
    {
        $this->DateAjout= $DateAjout;
        return $this;
    }


    public function getSurface(): ?string
    {
        return $this->Surface;
    }

    public function setSurface(string $Surface): self
    {
        $this->Surface= $Surface;
        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->CodePostal;
    }

    public function setCodePostal(int $CodePostal): self
    {
        $this->CodePostal= $CodePostal;
        return $this;
    }

    public function getNbrChambres(): ?string
    {
        return $this->NbrChambres;
    }

    public function setNbrChambres(string $NbrChambres): self
    {
        $this->NbrChambres= $NbrChambres;
        return $this;
    }

    public function getNbrEtages(): ?int
    {
        return $this->NbrEtages;
    }

    public function setNbrEtages(int $NbrEtages): self
    {
        $this->NbrEtages= $NbrEtages;
        return $this;
    }

    public function getGarage(): ?bool
    {
        return $this->Garage;
    }

    public function setGarage(int $Garage): self
    {
        $this->Garage= $Garage;
        return $this;
    }

    public function getParking(): ?bool
    {
        return $this->Parking;
    }

    public function setParking(int $Parking): self
    {
        $this->Parking= $Parking;
        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(int $Status): self
    {
        $this->Status= $Status;
        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias[] = $media;
            $media->setAnnonces($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getAnnonces() === $this) {
                $media->setAnnonces(null);
            }
        }

        return $this;
    }

      /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Annonce
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    
    public function addCategorie(categorie $categorie)
    {

           if ($this->categorie->contains($categorie)) {
            return;
        }


        $this->categorie[] = $categorie;

        return $this;
    }

    
    public function removeCategorie(categorie $categorie)
    {
        $this->categorie->removeElement($categorie);
    }

    /**
     * Get categorie
     *
     * @return Collection|categorie[]
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    
    /**
     * @return Collection|Favori[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favori $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->setAnnonce($this);
        }

        return $this;
    }

    public function removeFavori(Favori $favori): self
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getAnnonce() === $this) {
                $favori->setAnnonce(null);
            }
        }

        return $this;
    }

}
