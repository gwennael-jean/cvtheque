<?php

namespace App\Repository;

use App\Entity\Cv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cv[]    findAll()
 * @method Cv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CVRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cv::class);
    }

//    /**
//     * @return Cv[] Returns an array of Cv objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cv
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
