<?php

namespace App\Repository;

use App\Entity\ProjectVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectVideo[]    findAll()
 * @method ProjectVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectVideo::class);
    }

    // /**
    //  * @return ProjectVideo[] Returns an array of ProjectVideo objects
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
    public function findOneBySomeField($value): ?ProjectVideo
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
