<?php

namespace App\Repository;

use App\Entity\SomeBigEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SomeBigEntity>
 *
 * @method SomeBigEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SomeBigEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SomeBigEntity[]    findAll()
 * @method SomeBigEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SomeBigEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SomeBigEntity::class);
    }

    public function add(SomeBigEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SomeBigEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SomeBigEntity[] Returns an array of SomeBigEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SomeBigEntity
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
