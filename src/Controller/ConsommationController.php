<?php

namespace App\Controller;

use App\Entity\Compteur;
use App\Entity\Consommation;
use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConsommationController extends AbstractController
{
    private $em;
    private $cons_repository;
    private $compte_repository;
    private $facture_repository;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->em=$emi;
        $this->cons_repository=$this->em->getRepository(Consommation::class);
        $this->facture_repository=$this->em->getRepository(Facture::class);
        $this->compte_repository=$this->em->getRepository(Compteur::class);
    }

    /**
     * @Route("/consommation", name="app_consommation")
     */
    public function index()
    {
        $data["listconsoms"]=$this->cons_repository->findAll();
        return $this->render('consommation/index.html.twig',$data);
    }


    /**
     * @Route("/consommationadd", name="app_consommation_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {
        if($request->isMethod("POST"))
        {
            if($this->isCsrfTokenValid('cons_token', $request->request->get('token')))
            {
                $consommation=new Consommation();
                $facture=new Facture();

                $facture->setNumero("SN-".$request->request->get("nbrlitre").date('d-m-y'));
                $facture->setMontant($request->request->get("prixU")*$request->request->get("nbrlitre"));
                $facture->setDateFacturation($request->request->get("moiscons"));
                $facture->setDateLimite($request->request->get("datelimite"));
                $this->em->persist($facture);
                $this->em->flush();
                $idfacture=$facture->getId();
                if($idfacture >0 )
                {

                    $consommation->setDate($request->request->get("moiscons"));
                    $consommation->setCompteur($this->compte_repository
                        ->findOneBy(array(
                            "numero"=>$request->request->get("numcompteur")
                        )));
                    $consommation->setNombreLitre($request->request->get("nbrlitre"));
                    $consommation->setPrixUnitaire($request->request->get("prixU"));
                    $consommation->setFacturation($this->facture_repository->find($idfacture));
                    $this->em->persist($consommation);
                    $this->em->flush();
                }
            }
        }
        return $this->redirectToRoute("app_consommation");
    }
}
