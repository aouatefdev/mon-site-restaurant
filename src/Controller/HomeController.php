<?php

namespace App\Controller;

use App\Entity\Plats;
use App\Repository\PlatsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/', name:'app_home')]
    function homePlats(SessionInterface $session, PlatsRepository $platsRepository)
    {
        $panier = $session->get('panier', []);

        // pour enrichir le panier en créant un boucle sur le panier dans un tableau panierData//
        $panierData = [];
        $total = 0;
        $totalQtt = 0;
        if($totalQtt === 0){
            $totalQtt = null; 
        };
                foreach ($panier as $id => $qttPlats) {

                    $plats = $platsRepository->find($id);

                    $panierData[] = [
                        'plats' => $plats,
                        'qttPlats' => $qttPlats,
                        'totalQtt' => $totalQtt,
                    ];

                    $total += $plats->getPrix() * $qttPlats;
                    $totalQtt += $qttPlats;
                }
                
        return $this->render('home/home.html.twig', [
            'plats' => $platsRepository->findAll(),
            'datapanier' => $panierData,
            'total' => $total,
            'totalQtt' => $totalQtt,
        ]);
    }



    #[Route('/home/plats/add/{id}', name:'home_plats_add')]
    function add(Plats $plat, SessionInterface $session)
    {
      
        $panier = $session->get('panier', []);
        
        $id = $plat->getId();

        if (!empty($panier[$id])) {
            $panier[$id]++;
           
        }else{
            $panier[$id] = 1; 
        }
         
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_home");
    }
}

