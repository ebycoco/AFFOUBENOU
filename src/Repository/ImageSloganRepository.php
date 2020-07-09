<?php

namespace App\Repository;

use App\Entity\ImageSlogan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageSlogan|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageSlogan|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageSlogan[]    findAll()
 * @method ImageSlogan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageSloganRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageSlogan::class);
    }

    // /**
    //  * @return ImageSlogan[] Returns an array of ImageSlogan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageSlogan
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
