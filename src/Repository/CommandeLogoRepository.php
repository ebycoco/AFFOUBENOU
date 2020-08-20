<?php

namespace App\Repository;

use App\Entity\CommandeLogo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeLogo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeLogo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeLogo[]    findAll()
 * @method CommandeLogo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeLogoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeLogo::class);
    }

    public function findByLastCommand($value)
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

    public function findByLast()
    {
        return $this->createQueryBuilder('c') 
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(12)
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
    //  * @return CommandeLogo[] Returns an array of CommandeLogo objects
    //  */
    /*
    public function findAllVisibleQuery($value)
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
    public function findOneBySomeField($value): ?CommandeLogo
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
