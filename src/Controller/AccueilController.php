<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\AnnoncesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(AnnoncesRepository $repository): Response
    {
        $annonces = $repository->findAll();

        return $this->render('accueil/index.html.twig',[
            'annonces' => $annonces,
        ]);
    }

     /**
     * @Route("/fonctionnementPro", name="fonctionnementPro")
     */
    public function fonctionnementPro(Request $request)
    {
        return $this->render('accueil/FonctionnementPro.html.twig');
    }


     /**
     * @Route("/ChoixFonc", name="ChoixFonc")
     */
    public function ChoixFonc(Request $request)
    {
        return $this->render('accueil/ChoixFonc.html.twig');
    }


    /**
     * @Route("/fonctionnement", name="fonctionnement")
     */
    public function fonctionnement(Request $request)
    {
        return $this->render('accueil/Fonctionnement.html.twig');
    }
      /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, ManagerRegistry $om): Response
    {
       
        $Contact = new Contact();


        $form = $this->createFormBuilder($Contact)
        ->add('nom')
        ->add('email')
        ->add('subject')
        ->add('message')
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
        
        $Contact->setDatepublication(new \DateTime('now'));
        $em = $om->getManager();
        $em->persist($Contact);
        $em->flush();
        $this->addFlash("success","message envoyé");

        return $this->redirectToRoute("contact");

        }
    

        return $this->render('accueil/Contact.html.twig',
        array('form' => $form->createView())
    );

    

}

}
