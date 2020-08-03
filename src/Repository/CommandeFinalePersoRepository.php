<?php

namespace App\Repository;

use App\Entity\CommandeFinalePerso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeFinalePerso|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeFinalePerso|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeFinalePerso[]    findAll()
 * @method CommandeFinalePerso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeFinalePersoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeFinalePerso::class);
    }

    // /**
    //  * @return CommandeFinalePerso[] Returns an array of CommandeFinalePerso objects
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
    public function findOneBySomeField($value): ?CommandeFinalePerso
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
