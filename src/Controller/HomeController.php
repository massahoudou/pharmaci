<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\PaysRepository;
use App\Repository\VignetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $articleRepository;
    private $vignetteRepository;
    private $paysRepository;

    public function  __construct(ArticleRepository $articleRepository,VignetteRepository $vignetteRepository,PaysRepository $paysRepository)
    {
     
        $this->articleRepository = $articleRepository ;
        $this->vignetteRepository = $vignetteRepository ;
        $this->paysRepository = $paysRepository;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $Asection1 = $this->articleRepository->findsection(1);
        $Asection2 = $this->articleRepository->findsection(2);

        $Vsection1 = $this->vignetteRepository->findsection(1);
        $Vsection2 = $this->vignetteRepository->findsection(2);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'pays' => $this->paysRepository->findAll(),
            'Asectionone'  => $Asection1,
            'Asectiontwo' => $Asection2,
            'Vsectionone' => $Vsection1,
            'vsectiontwo' => $Vsection2,
        ]);
    }

      /**
     * @Route("/single", name="single")
     */
    public function single(): Response
    {
        return $this->render('single/index.html.twig', [
            'controller_name' => 'SingleController',
        ]);
    }
}
