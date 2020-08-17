<?php

namespace App\Repository;

use App\Entity\CategorieWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieWeb[]    findAll()
 * @method CategorieWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieWebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieWeb::class);
    }

    // /**
    //  * @return CategorieWeb[] Returns an array of CategorieWeb objects
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
    public function findOneBySomeField($value): ?CategorieWeb
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
