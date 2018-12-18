<?php

namespace App\Repository;

use App\Entity\Heroes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Heroes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Heroes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Heroes[]    findAll()
 * @method Heroes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Heroes::class);
    }

    /**
     * @return Heroes[]
     */
    public function findAllMale(): array
    {
        return$this->createQueryBuilder('h')
            ->andWhere('h.gender = m')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Heroes[] Returns an array of Heroes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Heroes
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
