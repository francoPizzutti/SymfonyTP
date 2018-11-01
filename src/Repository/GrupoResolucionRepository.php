<?php

namespace App\Repository;

use App\Entity\GrupoResolucion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GrupoResolucion|null find($id, $lockMode = null, $lockVersion = null)
 * @method GrupoResolucion|null findOneBy(array $criteria, array $orderBy = null)
 * @method GrupoResolucion[]    findAll()
 * @method GrupoResolucion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrupoResolucionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GrupoResolucion::class);
    }

//    /**
//     * @return GrupoResolucion[] Returns an array of GrupoResolucion objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GrupoResolucion
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
