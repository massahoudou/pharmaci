<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Conseil;
use App\Entity\Vignette;
use App\Repository\ArticleRepository;
use App\Repository\ConseilRepository;
use App\Repository\PaysRepository;
use App\Repository\PubRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VignetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;
use App\Repository\MaladienutritionRepository;

class HomeController extends AbstractController
{
    private $articleRepository;
    private $vignetteRepository;
    private $paysRepository;
    private $conseil;
    private $pub;
    private $category;
    private $maladienutritionRepository;

    public function  __construct(ArticleRepository $articleRepository, PubRepository $pub, ConseilRepository $conseil, VignetteRepository $vignetteRepository, PaysRepository $paysRepository, CategoryRepository $category, MaladienutritionRepository $maladienutritionRepository)
    {
        $this->conseil = $conseil;
        $this->articleRepository = $articleRepository;
        $this->vignetteRepository = $vignetteRepository;
        $this->paysRepository = $paysRepository;
        $this->pub = $pub;
        $this->category = $category;
        $this->maladienutritionRepository = $maladienutritionRepository;
    }

    /**
     * @Route("/recherche",name="recherche")
     */
    public function search(Request $request)
    {
      $maladies = $this->maladienutritionRepository->findByMaladies();
      $nutritions = $this->maladienutritionRepository->findByNutritions();
        $recherche = $request->get('recherche');

        return $this->render('home/recherche.html.twig', [
            'articles' => $this->articleRepository->findRecherche($recherche),
            'vignnettes' => $this->vignetteRepository->findRecherche($recherche),
            'maladies' => $maladies,
            'nutritions' => $nutritions,
            'pays' => $this->paysRepository->findPays(),

        ]);
    }

    public function home($pays)
    {
      $conseilslug = $this->conseil->findAll() ;
      $articlesslug = $this->articleRepository->findAll();
      $malnutslug = $this->maladienutritionRepository->findAll();
      $manager = $this->getDoctrine()->getManager();

      foreach ($conseilslug as $conseil) {

        if ($conseil->getSlug() == null ) {
          $conseildb = $this->conseil->find($conseil->getId());
          $titre = $conseildb->getTitre();
          $titre = str_replace(' ', '-', $titre);
          $conseildb->setSlug($titre);
          $manager->persist($conseildb);
          $manager->flush();
        }
      }
      foreach ($articlesslug as $article) {

        if ($article->getSlug() == null or  $article->getSlug() == '' ) {
          $articledb = $this->articleRepository->find($article->getId());
          $titre = $articledb->getTitre();
          $titre = str_replace(' ', '-', $titre);
          $articledb->setSlug($titre);
          $manager->persist($articledb);
          $manager->flush();
        }
      }
      foreach ($malnutslug as $malnut) {

        if ($malnut->getSlug() == null ) {
          $malnutdb = $this->maladienutritionRepository->find($malnut->getId());
          $titre = $malnutdb->getTitre();
          $titre = str_replace(' ', '-', $titre);
          $malnutdb->setSlug($titre);
          $manager->persist($malnutdb);
          $manager->flush();
        }
      }

        $categories = $this->category->findTitre();

        $categoriesarray = (array) $categories;

        for ($i = 0; $i < count($categoriesarray); $i++) {
            $categorie =  implode($categoriesarray[$i]);
            $repertoiresshuffle = $this->vignetteRepository->findByCategories($categoriesarray[$i]);
            shuffle($repertoiresshuffle);
            $repertoires[$categorie] = $repertoiresshuffle;

        }


        $articles =  $this->articleRepository->findRecent();
        $maladies = $this->maladienutritionRepository->findByMaladies();
        $nutritions = $this->maladienutritionRepository->findByNutritions();
        $carousels =  $this->pub->findsection(0, $pays);
        $pub1 =  $this->pub->findsection(1, $pays);
        $pub2  = $this->pub->findsection(2, $pays);
        $pub3 =  $this->pub->findsection(3, $pays);
        $pub4 =  $this->pub->findsection(4, $pays);
        $pub5 =  $this->pub->findsection(5, $pays);
        $pub6 =  $this->pub->findsection(6, $pays);
        $pub7 =  $this->pub->findsection(7, $pays);
        $pub8 =  $this->pub->findsection(8, $pays);
        $pub9 =  $this->pub->findsection(9, $pays);
        $pub10 =  $this->pub->findsection(10, $pays);
        $pub11 =  $this->pub->findsection(11, $pays);
        $pub12 =  $this->pub->findsection(12, $pays);

        shuffle($carousels);
        shuffle($pub1);
        shuffle($pub2);
        shuffle($pub3);
        shuffle($pub4);
        shuffle($pub5);
        shuffle($pub6);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'pays' => $this->paysRepository->findPays(),
            'articles' => $articles,
            'repertoires' => $repertoires,
            'conseils' => $this->conseil->findPays($pays),
            'carousels' => $carousels,
            'maladies' => $maladies,
            'nutritions' => $nutritions,
            'pub1' => $pub1,
            'pub2' => $pub2,
            'pub3' => $pub3,
            'pub4' => $pub4,
            'pub5' => $pub5,
            'pub6' => $pub6,
            'pub7' => $pub7,
            'pub8' => $pub8,
            'pub9' => $pub9,
            'pub10' => $pub10,
            'pub11' => $pub11,
            'pub12' => $pub12,
            'locat' => 'togo',
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        // $ip = $_SERVER['REMOTE_ADDR'];
        // $details = json_decode(file_get_contents("hhttp://ip-api.com/json/".$ip));
        // dd( $details ) ;
        $pays = 'togo';
        return  $this->home($pays);
    }
    /**
     * @Route("/{pays}-article-{slug}", name="single")
     */
    public function singleArticles($pays, $slug,  Request $request): Response
    {
        $article = $this->articleRepository->findPaysArticle($pays, $slug);
        $maladies = $this->maladienutritionRepository->findByMaladies();
        $nutritions = $this->maladienutritionRepository->findByNutritions();
        $articles =  $this->articleRepository->findRecent();


            return $this->render('single/index.html.twig', [
                'article' => $article,
                'articles' => $articles,
                'pays' => $this->paysRepository->findAll(),
                'conseils' => $this->conseil->findPays($pays),
                'pub1' => $this->pub->findsection(1, $pays),
                'maladies' => $maladies,
                'nutritions' => $nutritions,
            ]);


    }

    /**
     * @Route("/maladies-{titre}", name="maladie")
     */
    public function signleMaladies($titre)
    {
        $maladies = $this->maladienutritionRepository->findByMaladies();
        $nutritions = $this->maladienutritionRepository->findByNutritions();
        $maladie = $this->maladienutritionRepository->findOneBy(['titre' => $titre]);
        $articles =  $this->articleRepository->findRecent();

            return $this->render('single/maladiesnutrition.html.twig', [
                'maladienutrition' => $maladie,
                'articles' => $articles,
                'pays' => $this->paysRepository->findPays(),
                'maladies' => $maladies,
                'nutritions' => $nutritions,
                // 'pub3' => $this->pub->findsection(3,$pays),
            ]);

    }

    /**
     * @Route("/nutrition-{titre}", name="nutrition")
     */
    public function signleNutrition($titre)
    {
        $maladies = $this->maladienutritionRepository->findByMaladies();
        $nutritions = $this->maladienutritionRepository->findByNutritions();
        $nutrition = $this->maladienutritionRepository->findOneBy(['titre' => $titre]);
        $articles =  $this->articleRepository->findRecent();


            return $this->render('single/maladiesnutrition.html.twig', [
                'maladienutrition' => $nutrition,
                'articles' => $articles,
                'pays' => $this->paysRepository->findPays(),
                'maladies' => $maladies,
                'nutritions' => $nutritions,
                //'pub3' => $this->pub->findsection(3,$pays),
            ]);

    }
    /**
     * @Route("/{pays}-conseil-{titre}" , name="single.conseil")
     */
    public function singleconseil($pays, $titre)
    {

        $conseil = $this->conseil->findPaysConseil($pays, $titre);
        $maladies = $this->maladienutritionRepository->findByMaladies();
        $nutritions = $this->maladienutritionRepository->findByNutritions();
        $articles =  $this->articleRepository->findRecent();

            return $this->render('single/conseil.html.twig', [
                'conseil' => $conseil,
                'articles' => $articles,
                'pays' => $this->paysRepository->findPays(),
                'pub2' => $this->pub->findsection(2, $pays),
                'maladies' => $maladies,
                'nutritions' => $nutritions,
            ]);

    }
    /**
     * @Route("/pays={pays} ",name="pays")
     */
    public function pays($pays)
    {
        return $this->home($pays);
    }
    /**
     * @Route("/articles" , name="all.articles")
     */
    public function Allarticle()
    {
        $maladies = $this->maladienutritionRepository->findByMaladies();
        $nutritions = $this->maladienutritionRepository->findByNutritions();
        $articles =  $this->articleRepository->findRecent();

        shuffle($articles);
        return $this->render('home/allarticles.html.twig', [
            'articles' => $articles,
            'maladies' => $maladies,
            'nutritions' => $nutritions,
            'pays' => $this->paysRepository->findPays(),
        ]);
    }
    /**
     * @Route("/{locat}-repertoire-{categorie}" , name="all.repertoire")
     */
    public function repertoires($locat, $categorie)
    {

        $maladies = $this->maladienutritionRepository->findByMaladies();
        $nutritions = $this->maladienutritionRepository->findByNutritions();
        $vignette = $this->vignetteRepository->findByCategories($categorie);

        return $this->render('home/repertoire.html.twig', [
            'categorie' => $categorie,
            'vignettes' => $vignette,
            'maladies' => $maladies,
            'pays' => $this->paysRepository->findPays(),
            'nutritions' => $nutritions,
            'pub4' => $this->pub->findsection(4,$locat)
        ]);
    }


}
