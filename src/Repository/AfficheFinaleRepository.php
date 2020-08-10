<?php

namespace App\Repository;

use App\Entity\AfficheFinale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AfficheFinale|null find($id, $lockMode = null, $lockVersion = null)
 * @method AfficheFinale|null findOneBy(array $criteria, array $orderBy = null)
 * @method AfficheFinale[]    findAll()
 * @method AfficheFinale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AfficheFinaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AfficheFinale::class);
    }

    // /**
    //  * @return AfficheFinale[] Returns an array of AfficheFinale objects
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
    public function findOneBySomeField($value): ?AfficheFinale
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
