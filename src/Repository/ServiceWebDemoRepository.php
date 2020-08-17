<?php

namespace App\Repository;

use App\Entity\ServiceWebDemo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceWebDemo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceWebDemo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceWebDemo[]    findAll()
 * @method ServiceWebDemo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceWebDemoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceWebDemo::class);
    }

    public function voiruser($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.user = :val')
            ->setParameter('val', $value) 
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return ServiceWebDemo[] Returns an array of ServiceWebDemo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServiceWebDemo
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
