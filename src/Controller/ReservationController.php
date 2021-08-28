<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="suivre_reservation")
     */
    public function SuivreReservation($id,ReservationRepository $repository) {

        $user = $this->getUser();
        $idUser = $user->getId();
        $annonce = $this->getDoctrine()->getRepository(Annonces::class);
        $annonce = $annonce->find($id);


        $res = $repository->findReservation($idUser,$id);

        if (!$res) {
            throw $this->createNotFoundException(
                'Aucun article pour l\'id: ' . $id
            );
        }
        
        return $this->render(
            'reservation/suivreReservarion.html.twig',
            array('res' => $res,
            'annonce' => $annonce,));

    }

     /**
     * @Route("/reservation/valider/{id}", name="valider_res")
     */
    public function Valider(Reservation $res,ReservationRepository $rep)
    {
        $res->setEtat('Reservation acceptée');
        $em = $this->getDoctrine()->getManager();
        $em->persist($res);
        $em->flush();
        $user = $this->getUser();
        $idUser = $user->getId();
        $reservation = $rep->findReservationParClient($idUser);

        return $this->render(  'reservation/showAll.html.twig',
        array('res' => $reservation,));
    }

     /**
     * @Route("/reservation/refuser/{id}", name="refuser_res")
     */
    public function Refuser(Reservation $res,ReservationRepository $rep)
    {
        $res->setEtat('Reservation refusée');
        $em = $this->getDoctrine()->getManager();
        $em->persist($res);
        $em->flush();
        $user = $this->getUser();
        $idUser = $user->getId();
        $reservation = $rep->findReservationParClient($idUser);

        return $this->render(  'reservation/showAll.html.twig',
        array('res' => $reservation,));
    }

     /**
     * @Route("/reservation/ShowAll/{id}", name="show_all")
     */
    public function showAll($id,ReservationRepository $repository) {

        $user = $this->getUser();
        $idUser = $user->getId();


        $res = $repository->findReservationParClient($id);
        
        return $this->render(
            'reservation/showAll.html.twig',
            array('res' => $res,));

    }

     /**
     * @Route("/reservation/ajouter/{id}", name="ajouter_reservation")
     */
    public function AjoutReservation($id,Request $request, ManagerRegistry $om,ReservationRepository $rp): Response
    {
        $annonce = $this->getDoctrine()->getRepository(Annonces::class);
        $annonce = $annonce->find($id);
        $loueur = $annonce->getUser();
        $user = $this->getUser();
        $userNom = $user->getLastname();
        $userPreNom = $user->getFirstname();
        $userEmail = $user->getEmail();
        $userTelephone = $user->getNumTel();
        $userAdresse = $user->getAdresse();

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setAnnonce($annonce);
              $reservation->setLoueur($loueur);
              $reservation->setClient($user);
              $reservation->setDatereservation(new \DateTime('now'));
              $reservation->setEtat('En attente');
              $reservation->setNom($userNom);
              $reservation->setPrenom($userPreNom);
              $reservation->setEmail($userEmail);
              $reservation->setTelephone($userTelephone);
              $reservation->setAdresse($userAdresse);

            $em = $om->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute("detailsAnnonce",['id' => $annonce->getId()]);
        }
        return $this->render('reservation/ajouterReservation.html.twig', [
            "form" => $form->createView()
        ]);
   

    }

}
