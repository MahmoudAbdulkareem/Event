<?php

namespace App\Repository\EventGestion;

use App\Entity\EventGestion\GroupCompetition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupCompetition>
 *
 * @method GroupCompetition|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupCompetition|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupCompetition[]    findAll()
 * @method GroupCompetition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupCompetitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupCompetition::class);
    }

//    /**
//     * @return GroupCompetition[] Returns an array of GroupCompetition objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GroupCompetition
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
