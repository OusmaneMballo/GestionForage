<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{
    /**
     * @Route("/abonnement", name="app_abonnement_index")
     */
    public function index()
    {
        return $this->render('abonnement/index.html.twig', [
            'controller_name' => 'AbonnementController',
        ]);
    }
}
