<?php

namespace App\Repository;

use App\Entity\ReservationStatusEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationStatusEvent>
 *
 * @method ReservationStatusEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationStatusEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationStatusEvent[]    findAll()
 * @method ReservationStatusEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationStatusEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationStatusEvent::class);
    }

    public function save(ReservationStatusEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReservationStatusEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ReservationStatusEvent[] Returns an array of ReservationStatusEvent objects
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

//    public function findOneBySomeField($value): ?ReservationStatusEvent
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
