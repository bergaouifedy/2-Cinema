<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, ManagerRegistry $om, UserPasswordEncoderInterface $encoder): Response
    {
        $utilisateur = new User();
        $form = $this->createForm(InscriptionType::class, $utilisateur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordCrypte = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
              $utilisateur->setRoles("ROLE_USER");

            $em = $om->getManager();
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('admin_secu/inscription.html.twig', [
            "form" => $form->createView()
        ]);
    }

 /**
     * @Route("/inscriptionPro", name="inscription_Pro")
     */
    public function inscriptionPro(Request $request, ManagerRegistry $om, UserPasswordEncoderInterface $encoder): Response
    {
        $utilisateur = new User();
        $form = $this->createForm(InscriptionType::class, $utilisateur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordCrypte = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
              $utilisateur->setRoles("ROLE_PROFESSIONNEL");

            $em = $om->getManager();
            $em->persist($utilisateur);
            $em->flush();
            return $this->redirectToRoute("accueil");
        }
        return $this->render('admin_secu/inscriptionPro.html.twig', [
            "form" => $form->createView()
        ]);
    }

   /**
     * @Route("/Choix", name="Choix_Role_Page")
     */
    public function Choix(): Response
    {
        return $this->render('admin_secu/Choix.html.twig');
    }


    /**
     * @Route("/login", name="connexion")
     */
    public function login(AuthenticationUtils $util)
    {
        return $this->render("admin_secu/login.html.twig", [
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()

        ]);
        if ($this->getUser()->hasRole('ROLE_ADMIN'))
            return $this->redirect($this->generateUrl('/Admin/admin_index'));
        elseif ($this->getUser()->hasRole('ROLE_USER'))
            return $this->redirect($this->generateUrl('accueil'));
        throw new \Exception(AccessDeniedException::class);
    }

    /**
     * @Route("/logout", name="deconnexion")
     */
    public function logout()
    {
    }
}
