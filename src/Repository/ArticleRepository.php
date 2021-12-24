<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }
    public function findsection($section, $pays)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.position = :sec')
            ->setParameter('sec', $section)
            ->join('a.pays', 'p')
            ->andWhere('p.nom = :pa')
            ->setParameter('pa', $pays)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findRecent()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    public function findRandom()
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getResult();
    }
    public function findPaysArticle( $pays, $titre )
    {
        return $this->createQueryBuilder('a')
            ->join('a.pays','p')
            ->andWhere('a.titre = :titre')
            ->andWhere('p.nom = :pa')
            ->setParameter('pa', $pays)
            ->setParameter('titre',$titre)
            ->getQuery()
            ->getOneOrNullResult() 
        ;
    }


    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
