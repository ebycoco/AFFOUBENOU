<?php

namespace App\Repository;

use App\Entity\AvantageDuSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AvantageDuSite|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvantageDuSite|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvantageDuSite[]    findAll()
 * @method AvantageDuSite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvantageDuSiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvantageDuSite::class);
    }

    public function findByLast()
    {
        return $this->createQueryBuilder('a') 
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return AvantageDuSite[] Returns an array of AvantageDuSite objects
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
    public function findOneBySomeField($value): ?AvantageDuSite
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
