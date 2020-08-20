<?php

namespace App\Repository;

use App\Entity\CarteMenuFinale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteMenuFinale|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteMenuFinale|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteMenuFinale[]    findAll()
 * @method CarteMenuFinale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteMenuFinaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteMenuFinale::class);
    }

    // /**
    //  * @return CarteMenuFinale[] Returns an array of CarteMenuFinale objects
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
    public function findOneBySomeField($value): ?CarteMenuFinale
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
