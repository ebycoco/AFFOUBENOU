<?php

namespace App\Repository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use App\Entity\CarteVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteVisite[]    findAll()
 * @method CarteVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteVisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteVisite::class);
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

    public function findByLastCommandCarte($value) 
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    } 

    // /**
    //  * @return CarteVisite[] Returns an array of CarteVisite objects
    //  */
    /*
    public function findByLastCommand($value)
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
    public function findOneBySomeField($value): ?CarteVisite
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
