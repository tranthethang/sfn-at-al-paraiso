<?php

namespace App\Repository;

use App\Entity\ReservationStatusCatalog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationStatusCatalog>
 *
 * @method ReservationStatusCatalog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationStatusCatalog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationStatusCatalog[]    findAll()
 * @method ReservationStatusCatalog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationStatusCatalogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationStatusCatalog::class);
    }

    public function save(ReservationStatusCatalog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReservationStatusCatalog $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ReservationStatusCatalog[] Returns an array of ReservationStatusCatalog objects
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

//    public function findOneBySomeField($value): ?ReservationStatusCatalog
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
