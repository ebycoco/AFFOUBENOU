<?php

namespace App\Repository;

use App\Entity\CommandePredefiniePerso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandePredefiniePerso|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandePredefiniePerso|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandePredefiniePerso[]    findAll()
 * @method CommandePredefiniePerso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandePredefiniePersoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandePredefiniePerso::class);
    }

    // /**
    //  * @return CommandePredefiniePerso[] Returns an array of CommandePredefiniePerso objects
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
    public function findOneBySomeField($value): ?CommandePredefiniePerso
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
