<?php

namespace App\Controller;

use App\Entity\Compteur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompteurController extends AbstractController
{
    private $em;
    private $compteur_repository;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->em=$emi;
        $this->compteur_repository=$this->em->getRepository(Compteur::class);

    }


    /**
     * @Route("/compteur", name="app_compteur")
     */
    public function index()
    {
        $data['listcompteurs']=$this->compteur_repository->findAll();

        return $this->render('compteur/index.html.twig',$data);
    }

    /**
     * @Route("/compteuradd", name="app_compteur_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {
        if($request->isMethod("POST"))
        {
            if ($this->isCsrfTokenValid('compteur_token', $request->request->get('token')))
            {
                $compte=new Compteur();
                $compte->setNumero($request->request->get("numero"));
                $compte->setEtat("Non attribuer");
                $this->em->persist($compte);
                $this->em->flush();
                return $this->redirectToRoute("app_compteur");
            }
        }
        return $this->redirectToRoute("app_compteur");
    }

    /**
     * @Route("/coupure/{id<[0-9]+>}", name="app_compteur_coupure")
     */
    public function couppure(int $id)
    {
        $compteur=$this->compteur_repository->find($id);
        $compteur->setEtat("Couper");
        $this->em->flush();

        return $this->redirectToRoute('app_compteur');
    }
}
