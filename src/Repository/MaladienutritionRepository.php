<?php

namespace App\Repository;

use App\Entity\Maladienutrition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Maladienutrition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maladienutrition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maladienutrition[]    findAll()
 * @method Maladienutrition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaladienutritionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maladienutrition::class);
    }

     /**
      * @return Maladienutrition[] Returns an array of Maladienutrition objects
      */

    public function findByMaladies()
    {

        return $this->createQueryBuilder('m')
            ->andWhere('m.type = 0 ')
            ->orderBy('m.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
      /**
      * @return Maladienutrition[] Returns an array of Maladienutrition objects
      */

      public function findByNutritions()
      {
          return $this->createQueryBuilder('m')
              ->andWhere('m.type = 1 ' )
              ->orderBy('m.id', 'DESC')
              ->setMaxResults(10)
              ->getQuery()
              ->getResult()
          ;
      }

      public function findPaysMaladie( $pays, $titre )
      {
          return $this->createQueryBuilder('m')
              ->join('m.pays','p')
              ->andWhere('m.titre = :titre')
              ->andWhere('p.nom = :pa')
              ->andWhere('m.type = 0 ' )
              ->setParameter('pa', $pays)
              ->setParameter('titre',$titre)
              ->getQuery()
              ->getOneOrNullResult()
          ;
      }


    public function findPaysNutrition( $pays, $titre )
    {
        return $this->createQueryBuilder('m')
            ->join('m.pays','p')
            ->andWhere('m.titre = :titre')
            ->andWhere('p.nom = :pa')
            ->andWhere('m.type = 1 ' )
            ->setParameter('pa', $pays)
            ->setParameter('titre',$titre)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findRecherche($value)
    {
      return $this->createQueryBuilder('m')
          ->andWhere('m.titre LIKE :value')
            ->setParameter('value','%'.$value.'%')
          ->getQuery()
        ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Maladienutrition
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
