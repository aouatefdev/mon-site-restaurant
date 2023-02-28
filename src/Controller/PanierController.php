<?php

namespace App\Controller;

use App\Repository\PlatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{

    #[Route('/panier', name:'panier_index')]
    function showPlats(SessionInterface $session, PlatsRepository $platsRepository)
    {
        $panier = $session->get('panier', []);

        // pour enrichir le panier en créant un boucle sur le panier dans un tableau panierData//
        $panierData = [];
        $total = 0;
        $totalQtt = 0;


        foreach ($panier as $id => $qttPlats) {

            $plats = $platsRepository->find($id);

                $panierData[] = [
                    'plats' => $plats,
                    'qttPlats' => $qttPlats,
                ];
          
            $total += $plats->getPrix() * $qttPlats;
            $totalQtt += $qttPlats;  
        }

        return $this->render('panier/panier.html.twig', [
            'datapanier' => $panierData,
            'total' => $total,
            'totalQtt' => $totalQtt,
        ]);    
    }

    #[Route('/panier/plats/add/{id}', name:'panier_plats_add')]
    function add($id, SessionInterface $session, PlatsRepository $PlatsRepository)
        {
        // On récupère le panier actuel
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_index");
    }

    #[Route('/plats/diminuer/{id}', name:'plats_diminuer')]
    function diminuer($id, SessionInterface $session, PlatsRepository $PlatsRepository)
        {
        // On récupère le panier actuel

        $panier = $session->get("panier", [$id]);
        if (!empty($panier[$id])) {
            $panier[$id]--;
        } else {
            $panier[$id] = 1;
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_index");
    }

    #[Route('/plats/remove/{id}', name:'plats_remove')]
    function remove($id, SessionInterface $session, PlatsRepository $PlatsRepository)
        {
        // On récupère le panier actuel
        $panier = $session->get("panier", [$id]);
        if (!empty($panier[$id])) {

            unset($panier[$id]);
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_index");
    }

    #[Route('/remove', name:'remove_all')]
    function removeAll(SessionInterface $session)
        {
        $session->remove("panier");

        return $this->redirectToRoute("panier_index");
    }

}
