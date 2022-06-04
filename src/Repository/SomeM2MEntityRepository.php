<?php

namespace App\Repository;

use App\Entity\SomeM2MEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SomeM2MEntity>
 *
 * @method SomeM2MEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SomeM2MEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SomeM2MEntity[]    findAll()
 * @method SomeM2MEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SomeM2MEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SomeM2MEntity::class);
    }

    public function add(SomeM2MEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SomeM2MEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SomeM2MEntity[] Returns an array of SomeM2MEntity objects
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

//    public function findOneBySomeField($value): ?SomeM2MEntity
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
