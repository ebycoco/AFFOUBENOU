<?php

namespace App\Repository;

use App\Entity\AfficheFiligrame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AfficheFiligrame|null find($id, $lockMode = null, $lockVersion = null)
 * @method AfficheFiligrame|null findOneBy(array $criteria, array $orderBy = null)
 * @method AfficheFiligrame[]    findAll()
 * @method AfficheFiligrame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AfficheFiligrameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AfficheFiligrame::class);
    }

    // /**
    //  * @return AfficheFiligrame[] Returns an array of AfficheFiligrame objects
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
    public function findOneBySomeField($value): ?AfficheFiligrame
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
