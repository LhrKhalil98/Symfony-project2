<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="users", methods={"GET"})
     *  @IsGranted("ROLE_ADMIN")
     */
    public function index(UserRepository $userRepository): Response
    { 
        $users = new User() ; 
        $users =  $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users  
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function new(Request $request ,  UserPasswordEncoderInterface $encoder )

    { 
         if ($this->getUser()) {
           return $this->redirectToRoute('home');
        }
        $client = new User();
        $form = $this->createForm(UserType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword( $client,$client->getPassword());
            $client->setPassword($hash);
            $client->setRoles(array('ROLE_USER'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("profil/{id}", name="profil")
     */
    public function Profil(User $user ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function edit(Request $request, User $user): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
           
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('user/modifier.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
 


}
