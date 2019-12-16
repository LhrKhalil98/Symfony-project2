<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/propos", name="propos")
     */
    public function propos()
    {
        return $this->render('home/propos.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/FAQ", name="FAQ")
     */
    public function FAQ()
    {
        return $this->render('home/FAQ.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
