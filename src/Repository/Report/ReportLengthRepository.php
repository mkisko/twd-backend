<?php

namespace App\Repository\Report;

use App\Entity\Report\ReportLength;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReportLength|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportLength|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportLength[]    findAll()
 * @method ReportLength[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportLengthRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReportLength::class);
    }

    // /**
    //  * @return ReportLength[] Returns an array of ReportLength objects
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
    public function findOneBySomeField($value): ?ReportLength
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
