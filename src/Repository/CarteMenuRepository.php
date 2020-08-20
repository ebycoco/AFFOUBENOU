<?php

namespace App\Repository;

use App\Entity\CarteMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteMenu[]    findAll()
 * @method CarteMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteMenu::class);
    }

    /**
     * Undocumented function
     *
     * @param [type] $value
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
    //  * @return CarteMenu[] Returns an array of CarteMenu objects
    //  */
    /*
    public function findAllVisibleQuery($value): Query
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'DESC') 
            ->getQuery() 
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarteMenu
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
