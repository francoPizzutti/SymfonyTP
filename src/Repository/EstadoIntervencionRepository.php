<?php

namespace App\Repository;

use App\Entity\EstadoIntervencion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EstadoIntervencion|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoIntervencion|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoIntervencion[]    findAll()
 * @method EstadoIntervencion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoIntervencionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EstadoIntervencion::class);
    }

//    /**
//     * @return EstadoIntervencion[] Returns an array of EstadoIntervencion objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstadoIntervencion
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
