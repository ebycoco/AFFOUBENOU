<?php

namespace App\Repository;

use App\Entity\CarteMenuFiligramme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteMenuFiligramme|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteMenuFiligramme|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteMenuFiligramme[]    findAll()
 * @method CarteMenuFiligramme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteMenuFiligrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteMenuFiligramme::class);
    }

    // /**
    //  * @return CarteMenuFiligramme[] Returns an array of CarteMenuFiligramme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarteMenuFiligramme
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
