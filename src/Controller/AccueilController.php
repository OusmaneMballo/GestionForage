<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index()
    {
        $data['user']=$this->getUser();
        return $this->render('accueil/index.html.twig', $data);
    }

    /**
     * @Route("/abnnemnt", name="app_abonnement")
     */
    public function abonnement()
    {
     return $this->redirectToRoute('app_abonnement_index');
    }
}
