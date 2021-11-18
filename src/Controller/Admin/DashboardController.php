<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Pays;
Use App\Entity\Pub;
Use App\Entity\Miniature;
use App\Entity\Vignette;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Articles', 'fas fa-folder', Article::class);
        yield MenuItem::linkToCrud('Vignettes', 'fas fa-folder', Vignette::class);
        yield MenuItem::linkToCrud('Pays','fas fa-folder', Pays::class);
        yield MenuItem::linkToCrud('Publicités  ','fas fa-folder', Pub::class);
        yield MenuItem::linkToCrud('Minatures','fas fa-folder', Miniature::class);
        yield MenuItem::linkToCrud('utlisateurs', 'fas fa-folder', Vignette::class);
    }
}
