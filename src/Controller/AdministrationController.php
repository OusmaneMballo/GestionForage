<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdministrationController extends AbstractController
{
    private $em;
    private $user_repository;
    private $role_repository;
    private $encoder;

    public function __construct(EntityManagerInterface $emi, UserPasswordEncoderInterface $upei)
    {
        $this->em=$emi;
        $this->user_repository=$this->em->getRepository(User::class);
        $this->role_repository=$this->em->getRepository(Role::class);
        $this->encoder=$upei;
    }


    /**
     * @Route("/administration", name="app_administration")
     */
    public function index()
    {
        $data['roles']=$this->role_repository->findAll();
        $data['users']=$this->user_repository->findAll();

        return $this->render('administration/index.html.twig', $data);
    }

    /**
     * @Route("/administrationadd", name="app_administration_add", methods={"POST|PATCH"})
     */
    public function add(Request $request)
    {
        if($request->isMethod("POST"))
        {
            if ($this->isCsrfTokenValid('user_token', $request->request->get('token')))
            {
                if($request->request->get('role')!=null)
                {
                    $user=new User();
                    $user->setEmail($request->request->get("email"));
                    $hash =$this->encoder->encodePassword($user, $request->request->get("password"));
                    $user->setPassword($hash);
                    $user->setPrenomNom($request->request->get("prenom_nom"));
                    foreach ($request->request->get('role') as $role)
                    {
                        $user->addRole($this->role_repository->find($role));
                    }
                    $this->em->persist($user);
                    $this->em->flush();
                }
            }
        }
        return $this->redirectToRoute("app_administration");
    }
}
