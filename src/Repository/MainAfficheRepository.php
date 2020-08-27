<?php

namespace App\Repository;

use App\Entity\MainAffiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MainAffiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainAffiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainAffiche[]    findAll()
 * @method MainAffiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainAfficheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainAffiche::class);
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
    //  * @return MainAffiche[] Returns an array of MainAffiche objects
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
    public function findOneBySomeField($value): ?MainAffiche
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
