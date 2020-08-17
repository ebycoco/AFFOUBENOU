<?php

namespace App\Repository;

use App\Entity\AutreFonctionnalite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AutreFonctionnalite|null find($id, $lockMode = null, $lockVersion = null)
 * @method AutreFonctionnalite|null findOneBy(array $criteria, array $orderBy = null)
 * @method AutreFonctionnalite[]    findAll()
 * @method AutreFonctionnalite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutreFonctionnaliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AutreFonctionnalite::class);
    }

    // /**
    //  * @return AutreFonctionnalite[] Returns an array of AutreFonctionnalite objects
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
    public function findOneBySomeField($value): ?AutreFonctionnalite
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
