<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\DemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demande")
 */
class DemandeController extends AbstractController
{
    /**
     * @Route("/index", name="demande_index", methods={"GET"})
     */
    public function index(DemandeRepository $demandeRepository): Response
    {
        return $this->render('admin/gestion_demandes/index.html.twig', [
            'demandes' => $demandeRepository->findAll(),
        ]);
    }




    /**
     * @Route("/new", name="demande_new", methods={"GET","POST"})
     */
    public function new(Request $request, DemandeRepository $dr): Response
    {
        $demande = new Demande();
        $user = $this->getUser();
        $demandeUser = $dr->findDemandeParClient($user->getId());

        if ($demandeUser != null)
        {
            return $this->render('demande/show2.html.twig', [
                'demande' => $demandeUser,
            ]);   
        }
        else {
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $demande->setClient($user);
            $demande->setDateDemande(new \DateTime('now'));
            $demande->setEmail($user->getEmail());
            $demande->setNom($user->getLastname());
            $demande->setPrenom($user->getFirstname());
            $demande->setTelephone($user->getNumTel());
            $demande->setAdresse($user->getAdresse());
            $demande->setEtat("En attente");

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demande);
            $entityManager->flush();

            return $this->redirectToRoute('demande_show', ['id' => $demande->getId()], Response::HTTP_SEE_OTHER);
        }
    }

        return $this->renderForm('demande/new.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="demande_show", methods={"GET"})
     */
    public function show(Demande $demande, DemandeRepository $dr): Response
    {
        $user = $this->getUser();
        $demande = $dr->findDemandeParClient($user->getId());
        return $this->render('demande/show2.html.twig', [
            'demande' => $demande,
        ]);
    }


     /**
     * @Route("/Admin/{id}", name="demande_show_admin", methods={"GET"})
     */
    public function showDemande(Demande $demande): Response
    {
        return $this->render('admin/gestion_demandes/show.html.twig', [
            'demande' => $demande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Demande $demande): Response
    {
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demande/edit.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="demande_delete", methods={"POST"})
     */
    public function delete(Request $request, Demande $demande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demande_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/admin/demande/valider/{id}", name="valider_demande")
     */
    public function Valider(Demande $demande,DemandeRepository $repository)
    {
        $demande->setEtat("Acceptee");
        $em = $this->getDoctrine()->getManager();
        $em->persist($demande);
        $em->flush();
        $demandes = $repository->findAll();

        $this->addFlash("success","La validation de l'annonce a été effecutuée avec succés");
        return $this->render('admin/gestion_demandes/index.html.twig',[
            'demandes' => $demandes,
        ]);
    }


}
