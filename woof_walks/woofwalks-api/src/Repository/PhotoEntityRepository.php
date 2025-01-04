<?php

namespace App\Repository;

use App\Entity\PhotoEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PhotoEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoEntity::class);
    }

    /**
     * Trouver la photo liée à une Walk par l'ID de la Walk
     *
     * @param int $walkId L'ID de la Walk
     * @return PhotoEntity|null Retourne l'entité PhotoEntity ou null si aucune photo associée
     */
    public function findByWalkId(int $walkId): ?PhotoEntity
    {
  
        return $this->createQueryBuilder('p')
            ->andWhere('p.entity = :walkId')
            ->setParameter('walkId', $walkId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
