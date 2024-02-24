<?php

namespace App\Repository\CourseGestion;

use App\Entity\CourseGestion\RoadMap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoadMap>
 *
 * @method RoadMap|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoadMap|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoadMap[]    findAll()
 * @method RoadMap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoadMapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoadMap::class);
    }

//    /**
//     * @return RoadMap[] Returns an array of RoadMap objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RoadMap
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
