<?php

namespace App\Repository;

use App\Entity\ChefVillage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChefVillage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChefVillage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChefVillage[]    findAll()
 * @method ChefVillage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChefVillageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChefVillage::class);
    }

    // /**
    //  * @return ChefVillage[] Returns an array of ChefVillage objects
    //  */
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
    public function findOneBySomeField($value): ?ChefVillage
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
