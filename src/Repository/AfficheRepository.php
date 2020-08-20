<?php

namespace App\Repository;

use App\Entity\Affiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Affiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affiche[]    findAll()
 * @method Affiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AfficheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Affiche::class);
    }
    /**
     * @return Query
     */  
    public function findAllVisibleQuery($value): Query
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.user = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'DESC') 
            ->getQuery() 
        ;
    }
    // /**
    //  * @return Affiche[] Returns an array of Affiche objects
    //  */
    /*
    public function findAllVisibleQuery($value)
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
    public function findOneBySomeField($value): ?Affiche
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
