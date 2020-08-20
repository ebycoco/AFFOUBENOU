<?php

namespace App\Repository;

use App\Entity\CommandeLogoPersonalise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeLogoPersonalise|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeLogoPersonalise|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeLogoPersonalise[]    findAll()
 * @method CommandeLogoPersonalise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeLogoPersonaliseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeLogoPersonalise::class);
    }
    public function findByLastCommandperso($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :val') 
            ->setParameter('val', $value) 
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * @return Query
     */  
    public function findAllVisibleQuery($value): Query
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'DESC') 
            ->getQuery() 
        ;
    }

    // /**
    //  * @return CommandeLogoPersonalise[] Returns an array of CommandeLogoPersonalise objects
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
    public function findOneBySomeField($value): ?CommandeLogoPersonalise
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
