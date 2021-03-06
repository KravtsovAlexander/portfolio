<?php

namespace App\Repository;

use App\Entity\ProjectCondition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectCondition|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectCondition|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectCondition[]    findAll()
 * @method ProjectCondition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectConditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectCondition::class);
    }

    // /**
    //  * @return ProjectCondition[] Returns an array of ProjectCondition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjectCondition
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
