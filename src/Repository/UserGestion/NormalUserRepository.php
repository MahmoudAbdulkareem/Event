<?php

namespace App\Repository\UserGestion;

use App\Entity\UserGestion\NormalUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NormalUser>
 *
 * @method NormalUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method NormalUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method NormalUser[]    findAll()
 * @method NormalUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NormalUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NormalUser::class);
    }

//    /**
//     * @return NormalUser[] Returns an array of NormalUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NormalUser
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
