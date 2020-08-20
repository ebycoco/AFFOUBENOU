<?php

namespace App\Repository;

use App\Entity\BadgesFinale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BadgesFinale|null find($id, $lockMode = null, $lockVersion = null)
 * @method BadgesFinale|null findOneBy(array $criteria, array $orderBy = null)
 * @method BadgesFinale[]    findAll()
 * @method BadgesFinale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BadgesFinaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BadgesFinale::class);
    }

    // /**
    //  * @return BadgesFinale[] Returns an array of BadgesFinale objects
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
    public function findOneBySomeField($value): ?BadgesFinale
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
