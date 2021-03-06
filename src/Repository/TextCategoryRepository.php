<?php

namespace App\Repository;

use App\Entity\TextCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TextCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextCategory[]    findAll()
 * @method TextCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextCategory::class);
    }

    // /**
    //  * @return TextCategory[] Returns an array of TextCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TextCategory
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
