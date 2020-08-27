<?php

namespace App\Repository;

use App\Entity\MainCarteVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MainCarteVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainCarteVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainCarteVisite[]    findAll()
 * @method MainCarteVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainCarteVisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainCarteVisite::class);
    }
    public function findOne()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return MainCarteVisite[] Returns an array of MainCarteVisite objects
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
    public function findOneBySomeField($value): ?MainCarteVisite
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
