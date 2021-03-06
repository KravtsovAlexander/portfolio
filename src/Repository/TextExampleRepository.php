<?php

namespace App\Repository;

use App\Entity\TextExample;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TextExample|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextExample|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextExample[]    findAll()
 * @method TextExample[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextExampleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextExample::class);
    }

    // /**
    //  * @return TextExample[] Returns an array of TextExample objects
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
    public function findOneBySomeField($value): ?TextExample
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
