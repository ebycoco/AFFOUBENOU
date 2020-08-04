<?php

namespace App\Repository;

use App\Entity\CarteVisiteFiligramme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteVisiteFiligramme|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteVisiteFiligramme|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteVisiteFiligramme[]    findAll()
 * @method CarteVisiteFiligramme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteVisiteFiligrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteVisiteFiligramme::class);
    }

    // /**
    //  * @return CarteVisiteFiligramme[] Returns an array of CarteVisiteFiligramme objects
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
    public function findOneBySomeField($value): ?CarteVisiteFiligramme
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
