<?php

namespace App\Repository;

use App\Entity\Privillege;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Privillege|null find($id, $lockMode = null, $lockVersion = null)
 * @method Privillege|null findOneBy(array $criteria, array $orderBy = null)
 * @method Privillege[]    findAll()
 * @method Privillege[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrivillegeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Privillege::class);
    }

    // /**
    //  * @return Privillege[] Returns an array of Privillege objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Privillege
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
