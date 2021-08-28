<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 * fields={"username"},
 * message="Le user existe déja"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min=5,max=10,minMessage="il faut plus de 5 caractéres",maxMessage="il faut moins de 10 caractéresé")
     */
    private $username;

     /**
     * @ORM\Column(type="string")
     * @Assert\Length(min=5,max=10,minMessage="il faut plus de 5 caractéres",maxMessage="il faut moins de 10 caractéresé")
     */
    private $numTel;

    /**
     * @ORM\Column(type="string")
     */
    private $firstname;


    /**
     * @ORM\Column(type="string")
     */
    private $lastname;


    /**
     * @ORM\Column(type="string")
     */
    private $adresse;


    /**
     * @ORM\Column(type="string")
     */
    private $email;

    
    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min=5,max=10,minMessage="il faut plus de 5 caractéres",maxMessage="il faut moins de 10 caractéresé")
     */
    private $password;


    /**
     * @Assert\Length(min=5,max=10,minMessage="il faut plus de 5 caractéres",maxMessage="il faut moins de 10 caractéresé")
     * @Assert\EqualTo(propertyPath="password",message="Les mdp ne sont pas equivauts")
     */
    private $passwordVerification;

     /**
     * @ORM\Column(type="string")
     */
    private $role;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $PhotoProfil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Annonces",mappedBy="User",cascade={"all"}    )
     */
    private $annonces;

    /**
     * @ORM\OneToMany(targetEntity=Favori::class, mappedBy="User")
     */
    private $favoris;
    
    public function __construct()
    {
        $this->annonces = new ArrayCollection();
        $this->favoris = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username= $username;
        return $this;
    }

    public function getNumtel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel= $numTel;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(String $firstname): self
    {
        $this->firstname= $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(String $lastname): self
    {
        $this->lastname= $lastname;
        return $this;
    }


    
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(String $adresse): self
    {
        $this->adresse= $adresse;
        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(String $email): self
    {
        $this->email= $email;
        return $this;
    }

      
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(String $password): self
    {
        $this->password= $password;
        return $this;
    }

    

    public function getPasswordVerification(): ?string
    {
        return $this->passwordVerification;
    }

    public function setPasswordVerification(String $passwordVerification): self
    {
        $this->passwordVerification= $passwordVerification;
        return $this;
    }

    public function eraseCredentials()
    {
        
    }

    public function getSalt()
    {
        
    }


    public function getRoles()
    {
        return [$this->role];
    }

    public function setRoles(?String $role): self
    {
        
            $this->role= $role;
        
        return $this;
    }

    public function getUserIdentifier(){
        return $this->username;

    }

    public function getPhotoProfil(): ?string
    {
        return $this->PhotoProfil;
    }

    public function setPhotoProfil(string $PhotoProfil): self
    {
        $this->PhotoProfil= $PhotoProfil;
        return $this;
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
            $favori->setUser($this);
        }

        return $this;
    }

    public function removeFavori(Favori $favori): self
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getUser() === $this) {
                $favori->setUser(null);
            }
        }

        return $this;
    }
   
}
