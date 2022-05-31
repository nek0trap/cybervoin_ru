<?php

namespace App\Repository;

use App\Entity\CharacterSkillPreset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CharacterSkillPreset>
 *
 * @method CharacterSkillPreset|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterSkillPreset|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterSkillPreset[]    findAll()
 * @method CharacterSkillPreset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterSkillPresetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterSkillPreset::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CharacterSkillPreset $entity, bool $flush = true): void
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
    public function remove(CharacterSkillPreset $entity, bool $flush = true): void
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