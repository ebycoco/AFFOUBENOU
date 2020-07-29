<?php

namespace App\Repository;

use App\Entity\CommandeFinale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeFinale|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeFinale|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeFinale[]    findAll()
 * @method CommandeFinale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeFinaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeFinale::class);
    }

    // /**
    //  * @return CommandeFinale[] Returns an array of CommandeFinale objects
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
    public function findOneBySomeField($value): ?CommandeFinale
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
