<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\Client;
use App\Entity\Compteur;
use App\Entity\Village;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{
    private $em;
    private $abonnement_repository;
    private $client_repository;
    private $village_repository;
    private $compteur_repository;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->em=$emi;
        $this->abonnement_repository=$this->em->getRepository(Abonnement::class);
        $this->client_repository=$this->em->getRepository(Client::class);
        $this->village_repository=$this->em->getRepository(Village::class);
        $this->compteur_repository=$this->em->getRepository(Compteur::class);
    }

    /**
     * @Route("/abonnement", name="app_abonnement_index")
     */
    public function index()
    {
        $data['listClients']=$this->client_repository->findAll();
        $data['listVillages']=$this->village_repository->findAll();
        $data['listAbonnements']=$this->abonnement_repository->findAll();
        return $this->render('abonnement/index.html.twig',$data);
    }

    /**
     * @Route("/addabonnement", name="app_abonnement_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {
        if($request->isMethod("POST"))
        {
            if ($this->isCsrfTokenValid('abonnement_token', $request->request->get('token')))
            {
                $abonnement=new Abonnement();
                if($request->request->get('client')==-1)
                {
                    $idclient=$this->addClient($request);
                    $abonnement->setClient($this->client_repository->find($idclient));
                }
                elseif ($request->request->get('client')!=0)
                {
                    $abonnement->setClient($this->client_repository
                        ->findBy($request->request->get('client')));
                }
                $abonnement->setNumero($abonnement->getClient()->getPrenom()[0].$abonnement->getClient()->getNom()[0]."1234");
                $abonnement->setDescription($request->request->get('description'));
                $abonnement->setDate(date('d-m-y'));
                $this->em->persist($abonnement);
                $this->em->flush();
                return $this->redirectToRoute('app_abonnement_index');
            }
        }

        return $this->redirectToRoute('app_abonnement_index');
    }

    public function addClient(Request $request)
    {
        $client=new Client();
        $client->setNom($request->request->get('nom'));
        $client->setTelephone($request->request->get('telephone'));
        $client->setPrenom($request->request->get('prenom'));
        $client->setNci($request->request->get('nci'));
        $client->setDateNaiss($request->request->get('datenaiss'));
        if ($request->request->get('village')==-1)
        {

        }
        elseif ($request->request->get('village')!=0)
        {
            $client->setVillage($this->village_repository
                ->find($request->request->get('village')));
        }
        $this->em->persist($client);
        $this->em->flush();
        return $client->getId();
    }

    /**
     * @Route("/attribution/{id<[0-9]+>}", name="app_abonnement_attrib")
     */
    public function attribution(int $id)
    {
        $data["abonnement"]=$this->abonnement_repository->find($id);
        $data["listcompteurs"]=$this->compteur_repository->findBy(array("etat"=>"Non attribuer"));
        return $this->render('abonnement/attribution.html.twig',$data);
    }

    /**
     * @Route("/affectation", name="app_abonnement_affectation", methods={"POST|PATCH"})
     */
    public function attribCompteur(Request $request)
    {
        if($request->isMethod("POST"))
        {
            if($this->isCsrfTokenValid('attrib_token', $request->request->get('token')))
            {
                if($request->request->get('compteur')!=0)
                {
                    $compteur=$this->compteur_repository->find($request->request->get('compteur'));

                    if($compteur!=null)
                    {
                        $compteur->setEtat("Attribuer");
                        $abonnement=$this->abonnement_repository->find($request->request->get('abonnement'));
                        if($abonnement!=null)
                        {
                            $abonnement->setCompteur($compteur);
                            $this->em->flush();
                            return $this->redirectToRoute('app_abonnement_index');
                        }
                    }
                }
            }
        }

        return $this->redirectToRoute('app_abonnement_index');
    }
}
