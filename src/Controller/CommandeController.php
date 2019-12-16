<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\User ;
use App\Repository\CommandeRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande/{id}", name="commande")
     * 
     */
    public function Commander( LivreRepository $livre_repo  , $id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $commande = new Commande() ; 
        $commande->setClient($this->getUser()) ; 
        $commande-> setDate(new \DateTime()) ;
        $commande->setLivre($livre_repo->find($id)); 

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commande);
        $entityManager->flush();
        return $this->redirectToRoute('livre_show' ,[
            'id'=> $id ,
        ]);

    }
     /**
     * @Route("/admin/commandes", name="admin_commande")
     *  @IsGranted("ROLE_ADMIN")
     */
    public function index(CommandeRepository $commande_repo)
    {
        return $this->render('commande/aficher.html.twig', [
            'commandes' => $commande_repo->findAll(),
        ]);
    }

     /**
     * @Route("/commandes/{id}", name="profil_commande")
     * 
     */
    public function clientCommande(User $user)
    {
        $commandes = $user->getCommandes() ; 
        return $this->render('user/commandes.html.twig', [
            'commandes' => $commandes
        ]);
    }
  
    /**
     * @Route("/admin/commande/{id}", name="commmande_delete", methods={"DELETE"})
     *  @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Commande $commande)
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_commande');
    }
}
