<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\PaysRepository;
use App\Repository\PubRepository;
use App\Repository\MiniatureRepository;
use App\Repository\VignetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    private $articleRepository;
    private $vignetteRepository;
    private $paysRepository;
    private $miniatures;
    private $pub ;

    public function  __construct(ArticleRepository $articleRepository,PubRepository $pub, MiniatureRepository $miniatures, VignetteRepository $vignetteRepository,PaysRepository $paysRepository)
    {
        $this->miniatures = $miniatures;
        $this->articleRepository = $articleRepository ;
        $this->vignetteRepository = $vignetteRepository ;
        $this->paysRepository = $paysRepository;
        $this->pub = $pub;
    }
    public function home($pays)
    {
        $Asection1 = $this->articleRepository->findsection(1,$pays);
        $Asection2 = $this->articleRepository->findsection(2,$pays);
        $Asection3 = $this->articleRepository->findsection(3,$pays);
        $Asection4 = $this->articleRepository->findsection(4,$pays);

        $Vsection1 = $this->vignetteRepository->findsection(1,$pays);
        $Vsection2 = $this->vignetteRepository->findsection(2,$pays);
        $Vsection3 = $this->vignetteRepository->findsection(3,$pays);
        $Vsection4 = $this->vignetteRepository->findsection(4,$pays);

        $pub1 =  $this->pub->findsection(1,$pays);
        $pub2 =  $this->pub->findsection(2,$pays);
        $pub3  = $this->pub->findsection(3,$pays);
        $pub4 =  $this->pub->findsection(4,$pays);


        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'pays' => $this->paysRepository->findAll(),
            'Asectionone'  => $Asection1,
            'Asectiontwo' => $Asection2,
            'Asectionthree' => $Asection3,
            'Asectionfour' => $Asection4,
            'vsectionone' => $Vsection1,
            'vsectiontwo' => $Vsection2,
            'vsectionthree' => $Vsection3,
            'vsectionfour' => $Vsection4,
            'pub1' => $pub1 ,
            'pub2' => $pub2 ,
            'pub3' => $pub3 ,
            'pub4' => $pub4 ,
            'miniatures' => $this->miniatures->findsection($pays),
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $pays = 'togo';
       return  $this->home($pays);
    }
     /**
     * @Route("/{pays}_{titre}", name="single")
     */
    public function single( $pays, $titre ,  Request $request): Response
    {
        $article = $this->articleRepository->findOneBy(['titre' => $titre]);
        if( $article != null )
        {

            return $this->render('single/index.html.twig', [
                'article' => $article,
                'articles' => $this->articleRepository->findRecent(),
                'pays' => $this->paysRepository->findAll(),
                'miniatures' => $this->miniatures->findsection($pays),
                'pub1' => $this->pub->findsection(1,$pays)
            ]);
        }
        else {
            $titre = str_replace('-',' ',$titre );
            $article =  $this->articleRepository->findOneBy(['titre' => $titre] );
         
            return $this->render('single/index.html.twig', [
                'article' => $article,
                'articles' => $this->articleRepository->findRecent(),
                'pays' => $this->paysRepository->findAll(),
                'miniatures' => $this->miniatures->findsection($pays),
                'pub1' => $this->pub->findsection(1,$pays)

            ]);
        }
        
    }
    /**
     * @Route("/pays={pays} ",name="pays")
     */
    public function pays($pays)
    {
        return $this->home($pays);
    }

   
}
