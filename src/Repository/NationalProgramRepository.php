<?php

namespace App\Repository;

use App\Entity\NationalProgram;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NationalProgram|null find($id, $lockMode = null, $lockVersion = null)
 * @method NationalProgram|null findOneBy(array $criteria, array $orderBy = null)
 * @method NationalProgram[]    findAll()
 * @method NationalProgram[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationalProgramRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NationalProgram::class);
    }

    // /**
    //  * @return NationalProgram[] Returns an array of NationalProgram objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NationalProgram
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
