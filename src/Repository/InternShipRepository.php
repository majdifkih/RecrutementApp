<?php

namespace App\Repository;

use App\Entity\InternShip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InternShip>
 *
 * @method InternShip|null find($id, $lockMode = null, $lockVersion = null)
 * @method InternShip|null findOneBy(array $criteria, array $orderBy = null)
 * @method InternShip[]    findAll()
 * @method InternShip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InternShipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InternShip::class);
    }

//    /**
//     * @return InternShip[] Returns an array of InternShip objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InternShip
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
