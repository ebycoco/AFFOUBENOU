<?php

namespace App\Repository;

use App\Entity\BadgesFiligramme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BadgesFiligramme|null find($id, $lockMode = null, $lockVersion = null)
 * @method BadgesFiligramme|null findOneBy(array $criteria, array $orderBy = null)
 * @method BadgesFiligramme[]    findAll()
 * @method BadgesFiligramme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BadgesFiligrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BadgesFiligramme::class);
    }

    // /**
    //  * @return BadgesFiligramme[] Returns an array of BadgesFiligramme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BadgesFiligramme
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
