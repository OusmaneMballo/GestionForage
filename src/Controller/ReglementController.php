<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\Reglement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReglementController extends AbstractController
{
    private $em;
    private $reglement_repository;
    private $facture_repository;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->em=$emi;
        $this->reglement_repository=$this->em->getRepository(Reglement::class);
        $this->facture_repository=$this->em->getRepository(Facture::class);
    }

    /**
     * @Route("/reglement", name="app_reglement")
     */
    public function index()
    {
        $data["listFactureReglement"]=$this->facture_repository->findAll();
        return $this->render('reglement/index.html.twig',$data);
    }

    /**
     * @Route("/reglementadd", name="app_reglement_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {
        if ($request->isMethod("POST")) {
            if ($this->isCsrfTokenValid('reglement_token', $request->request->get('token'))) {
                $reglement = new Reglement();
                $reglement->setDate(date("d-m-y"));
                $this->em->persist($reglement);
                $this->em->flush();
                $facture = $this->facture_repository->findOneBy(array(
                    "numero" => $request->request->get("numfacture")
                ));
                $facture->setReglement($reglement);
                $this->em->flush();
            }
        }
        return $this->redirectToRoute("app_reglement");
    }
}
