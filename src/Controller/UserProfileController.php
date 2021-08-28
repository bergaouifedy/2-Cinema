<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProfileController extends AbstractController
{
    /**
     * @Route("/user/profile", name="user_profile")
     */
    public function index(): Response
    {
        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
        ]);
    }



    
     /**
     * @Route("/user/update/{id}", name="user_update")
     */
    public function Update(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository(User::class);
        $user = $user->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'There are no users with the following id: ' . $id
            );
        }
        $form = $this->createFormBuilder($user)
            ->add('username')
            ->add('firstname')
            ->add('lastname')
            ->add('adresse')
            ->add('numTel')
            ->add('PhotoProfil', FileType::class,[
                'label' => false,
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
             // On récupère les images transmises
             $images = $form->get('PhotoProfil')->getData();
             if ($images!=null){
             $fichier = md5(uniqid()).'.'.$images->guessExtension();
              // On copie le fichier dans le dossier uploads
             $images->move(
             $this->getParameter('images_directory'),
             $fichier
              );
              $user->setPhotoProfil($fichier);
            }
            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $em->flush();
            return $this->redirect($this->generateUrl('user_profile'));
        }
        return $this->render(
            'user_profile/edit.html.twig',
            array('form' => $form->createView())
        );
    }

     /**
     * @Route("/user/favori", name="annonces_favori")
     */
    public function AnnonceFavori(AnnoncesRepository $repository): Response
    {
        /**@var User $user*/
        $userId = $this->getUser()->getId();
      
         $annonces = $repository->findFavori($userId);
        return $this->render('/user_profile/listFavori.html.twig',[
            'annonces' => $annonces,
        ]);
    }

     /**
     * @Route("/user/avis/{id}", name="feed_back")
     */
    public function feedBack($id,AnnoncesRepository $repository): Response
    {
        /**@var User $user*/
        $userId = $this->getUser()->getId();
      
         $avis = $repository->findAvis($id);
        return $this->render('/user_profile/ListFeedBacks.html.twig',[
            'avis' => $avis,
        ]);
    }


}
