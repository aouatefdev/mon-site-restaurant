<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Entity\Plats;
use App\Entity\Commandes;
use App\Entity\Stockages;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;



class DashboardController extends AbstractDashboardController
{
    // #[IsGranted('ROLE_CLIENT', statusCode: 404, message: 'Post not found')]
    #[Route('/admin', name: 'app_admin')] 
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');  
    }
    
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mon Site Restaurant');    
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-comments', Users::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-comments', Commandes::class);
        yield MenuItem::linkToCrud('Plats', 'fas fa-map-marker-alt', Plats::class);
        yield MenuItem::linkToCrud('Stockages', 'fas fa-comments', Stockages::class);
    }
}
