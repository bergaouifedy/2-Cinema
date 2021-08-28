<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCinemaController extends AbstractController
{
    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_cinema/index.html.twig');
    }
}
