<?php

namespace App\Repository;

use App\Entity\CharacterStatsPreset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CharacterStatsPreset>
 *
 * @method CharacterStatsPreset|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterStatsPreset|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterStatsPreset[]    findAll()
 * @method CharacterStatsPreset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterStatsPresetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterStatsPreset::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CharacterStatsPreset $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CharacterStatsPreset $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CharacterStatsPreset[] Returns an array of CharacterStatsPreset objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CharacterStatsPreset
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
