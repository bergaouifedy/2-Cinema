<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="ltour_Demande")
 * @ORM\Entity(repositoryClass="App\Repository\DemandeRepository")
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="datetime")
     */
    private $datetournage;


      /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer")
     */
    private $duree;

     /**
     * @var int
     *
     * @ORM\Column(name="nombreEffectif", type="integer")
     */
    private $nombreeffectif;

       /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDemande", type="datetime")
     */
    private $dateDemande;


     /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;



    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;


    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;


    /**
     * @var string
     *
     * @ORM\Column(name="nomsociete", type="string", length=255)
     */
    private $nomsociete;

    /** 
   * @ORM\OneToOne(targetEntity="App\Entity\User") 
   * @ORM\JoinColumn(nullable=false)
   */
   private $client;



   /** 
   * @ORM\OneToOne(targetEntity="Annonces") 
   * @ORM\JoinColumn(nullable=false)
   */
   private $annonce;



     /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datetournage
     *
     * @param \DateTime $datetournage
     *
     * @return Demande
     */
    public function setDateTournage($datetournage)
    {
        $this->datetournage = $datetournage;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatetournage()
    {
        return $this->datetournage;
    }


    

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Demande
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

     /**
     * Set description
     *
     * @param string $description
     *
     * @return Demande
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Demande
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Demande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nombreeffectif
     *
     * @param integer $nombreeffectif
     *
     * @return Demande
     */
    public function setNombreEffectif($nombreeffectif)
    {
        $this->nombreeffectif = $nombreeffectif;

        return $this;
    }

    /**
     * Get nombreeffectif
     *
     * @return int
     */
    public function getNombreEffectif()
    {
        return $this->nombreeffectif;
    }


    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Demande
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return int
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Demande
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Demande
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set nomsociete
     *
     * @param string $nomsociete
     *
     * @return Demande
     */
    public function setNomsociete($nomsociete)
    {
        $this->nomsociete = $nomsociete;

        return $this;
    }

    /**
     * Get nomsociete
     *
     * @return string
     */
    public function getNomsociete()
    {
        return $this->nomsociete;
    }

   
    public function setClient(User $client)
    {
        $this->client = $client;

        return $this;
    }

 
    public function getClient()
    {
        return $this->client;
    }

  
   
   
    public function setAnnonce(Annonces $annonce)
    {
        $this->annonce = $annonce;

        return $this;
    }

  
    public function getAnnonce()
    {
        return $this->annonce;
    }
    /**
     * Constructor
     */
    public function __construct()
    {

    }

   
    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Demande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     *
     * @return Demande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }
}
