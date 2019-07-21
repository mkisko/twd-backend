<?php

namespace App\Repository\Report;

use App\Entity\Report\ReportCost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReportCost|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportCost|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportCost[]    findAll()
 * @method ReportCost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportCostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReportCost::class);
    }

    // /**
    //  * @return ReportCost[] Returns an array of ReportCost objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReportCost
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
