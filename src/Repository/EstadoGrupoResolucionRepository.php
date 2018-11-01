<?php

namespace App\Repository;

use App\Entity\EstadoGrupoResolucion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EstadoGrupoResolucion|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoGrupoResolucion|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoGrupoResolucion[]    findAll()
 * @method EstadoGrupoResolucion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoGrupoResolucionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EstadoGrupoResolucion::class);
    }

//    /**
//     * @return EstadoGrupoResolucion[] Returns an array of EstadoGrupoResolucion objects
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
    public function findOneBySomeField($value): ?EstadoGrupoResolucion
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
