<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     *  @IsGranted("ROLE_ADMIN")
     */
    public function index()
    { 
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
     /**
     * @Route("/admin/users/ajouteradmin", name="ajouter_admin")
     *  
     */
    public function newAdmin(SymfonyRequest $request ,  UserPasswordEncoderInterface $encoder )

    { 
        $client = new User();
        $form = $this->createForm(AdminType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword( $client ,$client->getPassword());
            $client->setPassword($hash);
            $client->setRoles(array('ROLE_ADMIN'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('users');
        }

        return $this->render('admin/ajouteradmin.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
