<?php

namespace App\Repository;

use App\Entity\Conseil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conseil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conseil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conseil[]    findAll()
 * @method Conseil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConseilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conseil::class);
    }
    public function findPays( $pays )
    {
        return $this->createQueryBuilder('co')
            ->join('co.pays','p')
            ->andWhere('p.nom = :pa')
            ->setParameter('pa', $pays)
            ->orderBy('co.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findPaysConseil( $pays, $titre )
    {
        return $this->createQueryBuilder('co')
            ->join('co.pays','p')
            ->andWhere('co.slug = :titre')
            ->andWhere('p.nom = :pa')
            ->setParameter('pa', $pays)
            ->setParameter('titre',$titre)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findRecherche($value)
    {
      return $this->createQueryBuilder('co')
          ->andWhere('co.titre LIKE :value')
            ->setParameter('value','%'.$value.'%')
          ->getQuery()
          ->getResult();
    }

    // /**
    //  * @return Conseil[] Returns an array of Conseil objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Conseil
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
