<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    // Ajoute ici des méthodes personnalisées si nécessaire
    public function findAdByTitle($title)
    {
        // return $this->createQueryBuilder('a')
        //     ->andWhere('a.title = :title')
        //     ->setParameter('title', $title)
        //     ->getQuery()
        //     ->getOneOrNullResult();
    }
}
