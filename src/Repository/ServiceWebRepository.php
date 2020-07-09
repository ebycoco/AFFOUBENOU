<?php

namespace App\Repository;

use App\Entity\ServiceWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceWeb[]    findAll()
 * @method ServiceWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceWebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceWeb::class);
    }

    // /**
    //  * @return ServiceWeb[] Returns an array of ServiceWeb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServiceWeb
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
