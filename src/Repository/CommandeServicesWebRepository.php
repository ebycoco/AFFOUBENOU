<?php

namespace App\Repository;

use App\Entity\CommandeServicesWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeServicesWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeServicesWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeServicesWeb[]    findAll()
 * @method CommandeServicesWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeServicesWebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeServicesWeb::class);
    }

    public function findByLastCommandweb($value)
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
    public function findByLastCommanddepot($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.lien = :val') 
            ->setParameter('val', $value) 
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
    public function voiruser($value,$value1)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.user = :val')
            ->andWhere('s.id = :val')
            ->setParameter('val', $value) 
            ->setParameter('val', $value1) 
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return CommandeServicesWeb[] Returns an array of CommandeServicesWeb objects
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
    public function findOneBySomeField($value): ?CommandeServicesWeb
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
