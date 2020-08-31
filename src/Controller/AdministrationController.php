<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    private $em;
    private $user_repository;
    private $role_repository;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->em=$emi;
        $this->user_repository=$this->em->getRepository(User::class);
        $this->role_repository=$this->em->getRepository(Role::class);
    }


    /**
     * @Route("/administration", name="app_administration")
     */
    public function index()
    {
        $data['roles']=$this->role_repository->findAll();

        return $this->render('administration/index.html.twig', $data);
    }
}
