<?php

namespace App\Repository;

use App\Entity\Graphisme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Graphisme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Graphisme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Graphisme[]    findAll()
 * @method Graphisme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GraphismeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Graphisme::class);
    }

    // /**
    //  * @return Graphisme[] Returns an array of Graphisme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Graphisme
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
