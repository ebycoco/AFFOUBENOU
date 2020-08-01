<?php

namespace App\Repository;

use App\Entity\CommandePredefine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandePredefine|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandePredefine|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandePredefine[]    findAll()
 * @method CommandePredefine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandePredefineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandePredefine::class);
    }

    public function findByLast()
    {
        return $this->createQueryBuilder('c') 
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return CommandePredefine[] Returns an array of CommandePredefine objects
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
    public function findOneBySomeField($value): ?CommandePredefine
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
