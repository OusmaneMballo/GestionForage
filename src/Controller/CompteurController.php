<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompteurController extends AbstractController
{
    /**
     * @Route("/compteur", name="app_compteur")
     */
    public function index()
    {
        return $this->render('compteur/index.html.twig');
    }
}
