<?php

namespace App\Controller\Admin;

use App\Entity\Annonces;
use App\Repository\AnnoncesRepository;
use App\Repository\CategorieRepository;
use App\Entity\categorie;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionAnnonceController extends AbstractController
{
    /**
     * @Route("/admin/tousannonces", name="tousannonces")
     */
    public function AllAnnonces(AnnoncesRepository $repository): Response
    {
        $annonces = $repository->findAll();
        return $this->render('admin/gestion_annonce/AllAnnonces.html.twig',[
            'annonces' => $annonces,
        ]);
    }


    /**
     * @Route("/admin/valider/{id}", name="valider")
     */
    public function Valider(Annonces $annonce,AnnoncesRepository $repository)
    {
        $annonce->setStatus(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($annonce);
        $em->flush();
        $annonces = $repository->findAll();

        $this->addFlash("success","La validation de l'annonce a été effecutuée avec succés");
        return $this->render('admin/gestion_annonce/AllAnnonces.html.twig',[
            'annonces' => $annonces,
        ]);
    }


     /**
     * @Route("/admin/ajouterCategorie", name="ajout_categorie")
     */
    public function ajouterCategorie(AnnoncesRepository $repository,CategorieRepository $repos,Request $request, ManagerRegistry $om)
    {
       
        $categorie = new categorie();

        $form = $this->createFormBuilder($categorie)
        ->add('titre')
        ->add('description')
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {

        $em = $om->getManager();
        $em->persist($categorie);
        $em->flush();
        $annonces = $repository->findAll();

        return $this->redirect($this->generateUrl('touscategorie'));
     }
     return $this->render(
        'admin/gestion_annonce/ajoutCategorie.html.twig',
        array('form' => $form->createView())
    );
}

 /**
     * @Route("/admin/delete/{id}" , name="annonce_delete_admin")
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

        return $this->redirect($this->generateUrl('tousannonces'));

    }
 /**
     * @Route("/admin/touscategories", name="touscategorie")
     */
    public function AllCategories(CategorieRepository $repository): Response
    {
        $categorie = $repository->findAll();
        return $this->render('admin/gestion_annonce/AllCategorie.html.twig',[
            'categorie' => $categorie,
        ]);
    }

}
