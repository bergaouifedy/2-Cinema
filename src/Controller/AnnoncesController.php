<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Avis;
use App\Entity\Favori;
use App\Entity\Media;
use App\Entity\User;
use App\Form\AnnonceType;
use App\Repository\AnnoncesRepository;
use App\Repository\AvisRepository;
use App\Repository\FavoriRepository;
use App\Repository\MediaRepository;
use App\Entity\categorie;
use App\Entity\RechercheAnnonce;
use App\Entity\Reservation;
use App\Form\RechercheAnnonceType;
use App\Repository\CategorieRepository;
use App\Repository\ReservationRepository;
use Container8YCG1Vx\PaginatorInterface_82dac15;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AnnoncesController extends AbstractController
{
    /**
     * @Route("/annonces/immobiliers", name="annonces_immobiliers")
     */
    public function indexImmobiliers(AnnoncesRepository $repository,MediaRepository $repos, PaginatorInterface $pagitorInterface, Request $request): Response
    {
        $search = new RechercheAnnonce();
        $form = $this->createForm(RechercheAnnonceType::class,$search);
        $form->handleRequest($request);
        $annonces = $pagitorInterface->paginate(
            $repository->findAllWithPagination($search), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6/*limit per page*/
        );
        return $this->render('annonces/indexImmobiliers.html.twig',[
            'annonces' => $annonces,
            'form' => $form->createView()
        ]);
    }

      /**
     * @Route("/annonces/Personnelles", name="annonces_perso")
     */
    public function AnnoncePerso(AnnoncesRepository $repository): Response
    {
        $annonces = $repository->findAll();
        return $this->render('annonces/annoncesPerso.html.twig',[
            'annonces' => $annonces,
        ]);
    }

    /**
     * @Route("/ajoutAnnonces", name="ajouterAnnonces")
     */
    public function AjoutAnnonces(Request $request, ManagerRegistry $om): Response
    {
        $annonces = new Annonces();
        $form = $this->createFormBuilder($annonces)
        ->add('Titre')
        ->add('Description')
        ->add('typeTarification',ChoiceType::class, array(
            'choices'  => array(
                 'Par heure' => 'Par heure',
                'Par jour' => 'Par jour',
                'Par semaine' => 'Par semaine',
                'Par mois' => 'Par mois'
               
            ),
              
             'attr' => array('class'=>'form-control','placeholder'=>'Type de tarification ','required'=>true ,'property_path' => false,
             'multiple'  => false,
              'placeholder' => '',
             
        
             
        
        )
        
           ))
        
                
        ->add('Prix')
        ->add('Adresse')
        ->add('Surface',ChoiceType::class, array(
            'choices'  => array(
                'Inf??rieur ?? 100 m2' => 'Inf??rieur ?? 100 m2',
                'Entre 101 et 149 m2' => 'Entre 101 et 149 m2',
                'Entre 201 et 300 m2' => 'Entre 201 et 300 m2',
                'Entre 150 et 200 m2' => 'Entre 150 et 200 m2',
                'Entre 301 et 500 m2' => 'Entre 301 et 500 m2',
                'Entre 501 et 1000 m2' => 'Entre 501 et 1000 m2',
                'Sup??rieur ?? 1000 m2' => 'Sup??rieur ?? 1000 m2'
            
            ),
              
             'attr' => array('class'=>'form-control','placeholder'=>'surface Totale','required'=>true ,'property_path' => false,
             'multiple'  => false,
              'placeholder' => '',
             
        
             
        
        )
        
           ))
           ->add('ville',ChoiceType::class, array(
            'choices'  => array(
                 'Tunis' => 'Tunis',
                'Sfax' => 'Sfax',
                'Sousse' => 'Sousse',
                'Kairouen' => 'Kairouen',
                'Bizerte'=>'Bizerte',
                'Gab??s'=>'Gab??s',
                'Ariana'=>'Ariana',
                'Gafsa'=>'Gafsa',
                'Monastir'=>'Monastir',
                'Ben arous'=>'Ben arous',
                'Kasserine'=>'Kasserine',
                'Mednine'=>'Mednine',
                'Nabeul'=>'Nabeul',
                'Tataouine'=>'Tataouine',
                'B??ja'=>'B??ja',
                'Kef'=>'Kef',
                'Mahdia'=>'Mahdia',
                'Sidi bouzid'=>'Sidi bouzid',
                'Jandouba'=>'Jandouba',
                'Tozeur'=>'Tozeur',
                'Manouba'=>'Manouba',
                'Siliana'=>'Siliana',
                'Zghouan'=>'Zghouan',
                'K??bili'=>'K??bili'
              
               
            ),
              
             'attr' => array('class'=>'form-control','placeholder'=>'Ville','required'=>true ,'property_path' => false,
            
              'placeholder' => 'Ville',
             
        
             
        
        )
        
           ))     
        ->add('CodePostal',NumberType::class, array('attr'=>array('class'=>'form-control')))
        ->add('NbrChambres',ChoiceType::class, array(
            'choices'  => array(
                '1 ?? 5' => '1 ?? 5',
                '6 ?? 10' => '6 ?? 10',
                '11 ?? 20' => '11 ?? 20',
                'Sup??rieur ?? 20' => 'Sup??rieur ?? 20'
            ),
              
             'attr' => array('class'=>'form-control','placeholder'=>'nbrPiece','required'=>true ,'property_path' => false,
             'multiple'  => false,
              'placeholder' => '',
             
        
             
        
        )
        
           )) 
        ->add('NbrEtages',NumberType::class, array('attr'=>array('class'=>'form-control')))
        ->add('Garage', ChoiceType::class, [
            'choices'  => [
                'Oui' => true,
                'Non' => false,
            ],
        ])
        ->add('Parking', ChoiceType::class, [
            'choices'  => [
                'Oui' => true,
                'Non' => false,
            ],
        ])       
        ->add('Image', FileType::class,[
            'label' => false,
            'multiple' => false,
            'mapped' => false,
            'required' => false
        ])
        ->add('categorie', EntityType::class, [
            'class' => categorie::class,
            // this method must return an array of User entities
            'choice_label' => 'Titre',
            'multiple' => true,
            ])
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $user = $this->getUser();
         // On r??cup??re les images transmises
            $images = $form->get('Image')->getData();
            $fichier = md5(uniqid()).'.'.$images->guessExtension();
             // On copie le fichier dans le dossier uploads
            $images->move(
            $this->getParameter('images_directory'),
            $fichier
             );
            $annonces->setImage($fichier);
            $annonces->setUser($user);
            $annonces->setDate_Ajout(new \DateTime('now'));
            $annonces->setRef(rand());
            $annonces->setStatus(false);
            $annonces->setType("Immobilier");


            $em = $om->getManager();
            $em->persist($annonces);
            $em->flush();
            return $this->redirectToRoute("annonces_immobiliers");
        

        }
        return $this->render('annonces/ajoutAnnonce.html.twig',[
            "form" => $form->createView(),

        ]);
    }


    /**
     * @Route("/annonces/{id}", name="detailsAnnonce")
     */
    public function viewAction($id,AnnoncesRepository $repository,MediaRepository $repos,ReservationRepository $rp) {
        $annonce = $this->getDoctrine()->getRepository(Annonces::class);
        $annonce = $annonce->find($id);

        $user = $this->getUser();
        $idUser = $user->getId();

        
        $res = $rp->findReservation($idUser,$id);

        

        $etat = $rp->findEtatReservation($idUser,$id);


        if (!$annonce) {
            throw $this->createNotFoundException(
                'Aucun article pour l\'id: ' . $id
            );
        }
        $idA = $annonce->getId();
        $media = $repos->findImagesByAnnonce($idA);
        return $this->render(
            'annonces/DetailAnnonce.html.twig',
            array('annonce' => $annonce,
            'media' => $media,
            'res' =>$res),
            
        );

    }

        /**
     * @Route("/annonces/{id}/calendrier", name="calendrier_annonce")
     */
    public function viewCalendrier($id,ReservationRepository $rp) {
      
        $events = $rp->findReservationParAnnonce($id); 

        $rdvs =  [];

        foreach ($events as $events)
        {
           $rdvs[] = [
            'id' => $events->getId(),
            'title' => $events->getNomsociete(),
            'start' => $events->getDatedebut()->format('Y-m-d H:i:s'),
            'end' => $events->getDatefin()->format('Y-m-d H:i:s'),


           ] ;
        }
        $data = json_encode($rdvs);

      
        return $this->render(
            'annonces/VoirCalendrier.html.twig', compact('data')
            
        );

    }

    /**
     * @Route("/delete/{id}" , name="annonce_delete")
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $annonce = $this->getDoctrine()->getRepository(Annonces::class);
        $annonce = $annonce->find($id);

        if (!$annonce) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }

        $em->remove($annonce);
        $em->flush();

        return $this->redirect($this->generateUrl('annonces_immobiliers'));

    }


     /**
     * @Route("/annonce/update/{id}", name="annonce_update")
     */
    public function Update(Request $request, $id)
    {
        $annonce = $this->getDoctrine()->getRepository(Annonces::class);
        $annonce = $annonce->find($id);
        if (!$annonce) {
            throw $this->createNotFoundException(
                'There are no annonce  with the following id: ' . $id
            );
        }
        $form = $this->createFormBuilder($annonce)
            ->add('Titre')
            ->add('Description')
            ->add('Type')
            ->add('Prix')
            ->add('Surface')
            ->add('CodePostal')
            ->add('NbrChambres')
            ->add('NbrEtages')
            ->add('Garage')
            ->add('Parking')
            ->add('Media', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $medias = $form->get('Media')->getData();
            // On boucle sur les images
    foreach($medias as $image){
        // On g??n??re un nouveau nom de fichier
        $fichier = md5(uniqid()).'.'.$image->guessExtension();
        
        // On copie le fichier dans le dossier uploads
        $image->move(
            $this->getParameter('images_directory'),
            $fichier
        );
        
        // On cr??e l'image dans la base de donn??es
        $img = new Media();
        $img->setImage($fichier);
        $annonce->addMedia($img);
    }

            $em = $this->getDoctrine()->getManager();
            $annonce = $form->getData();
            $em->flush();
            $this->addFlash("success","La modification de l'annonce a ??t?? effecutu??e avec succ??s");

            return $this->redirect($this->generateUrl('annonces_immobiliers'));
        }
        return $this->render(
            'annonces/edit.html.twig',
            array('form' => $form->createView())
        );
    }

     /**
     * @Route("/annonces/catalogue/{id}", name="catalogue")
     */
    public function showCatalogue(AnnoncesRepository $repository,MediaRepository $repos, $id)
    {
        $annonce = $this->getDoctrine()->getRepository(Annonces::class);
        $annonce = $annonce->find($id);
        $idA = $annonce->getId();
        $media = $repos->findImagesByAnnonce($idA);

        return $this->render(
            'annonces/catalogue.html.twig',
            array('media' => $media,
                    'annonce'=>$annonce),
        );

    }

    /**
     * @Route("/annonces/avis/{id}", name="ajouter_avis")
     */
    public function ajouterAvis(AnnoncesRepository $repository,AvisRepository $repos, $id ,Request $request, ManagerRegistry $om)
    {
        $annonce = $this->getDoctrine()->getRepository(Annonces::class);
        $annonce = $annonce->find($id);
        $avis = new Avis();

        if (!$annonce) {
            throw $this->createNotFoundException(
                'There are no annonce  with the following id: ' . $id
            );
        }

        $form = $this->createFormBuilder($avis)
        ->add('nomcomplete')
        ->add('email')
        ->add('avis')
        ->add('message')
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $user = $this->getUser();
        
        $avis->setAnnonce($annonce);
        $avis->setDatepublication(new \DateTime('now'));
        $em = $om->getManager();
        $em->persist($avis);
        $em->flush();

        return $this->redirectToRoute("annonces_immobiliers");
        }

        return $this->render(
            'annonces/ajoutAvis.html.twig',
            array('form' => $form->createView())
        );

    }

     /**
     * @Route("/annonces/favori/{id}", name="ajouter_favori")
     */
    public function ajouterFavori(AnnoncesRepository $repository,FavoriRepository $repos, $id ,Request $request, ManagerRegistry $om)
    {
        $annonce = $this->getDoctrine()->getRepository(Annonces::class);
        $annonce = $annonce->find($id);
        $favori = new Favori();
        $user = $this->getUser();

        $favori->setAnnonce($annonce);
        $favori->setUser($user);
        $em = $om->getManager();
        $em->persist($favori);
        $em->flush();

        return $this->redirectToRoute("annonces_immobiliers");
    }

    /**
     * @Route("/annonce/reservation/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Reservation $calendar, Request $request)
    {
        // On r??cup??re les donn??es
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->start))

        {
            // Les donn??es sont compl??tes
            // On initialise un code
            $code = 200;

            // On v??rifie si l'id existe
            if(!$calendar){
                // On instancie un rendez-vous
                $calendar = new Reservation;

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les donn??es
            $calendar->setNomsociete($donnees->title);
            $calendar->setDatedebut(new DateTime($donnees->start));
          
            $calendar->setDatefin(new DateTime($donnees->end));
           
         

            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        }else{
            // Les donn??es sont incompl??tes
            return new Response('Donn??es incompl??tes', 404);
        }


        return $this->render('annonces/DetailAnnonce.html.twig');
    }

}
