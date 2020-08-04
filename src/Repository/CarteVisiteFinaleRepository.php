<?php

namespace App\Repository;

use App\Entity\CarteVisiteFinale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteVisiteFinale|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteVisiteFinale|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteVisiteFinale[]    findAll()
 * @method CarteVisiteFinale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteVisiteFinaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteVisiteFinale::class);
    }

    // /**
    //  * @return CarteVisiteFinale[] Returns an array of CarteVisiteFinale objects
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
    public function findOneBySomeField($value): ?CarteVisiteFinale
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
