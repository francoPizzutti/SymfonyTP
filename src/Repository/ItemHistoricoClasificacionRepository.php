<?php

namespace App\Repository;

use App\Entity\ItemHistoricoClasificacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ItemHistoricoClasificacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemHistoricoClasificacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemHistoricoClasificacion[]    findAll()
 * @method ItemHistoricoClasificacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemHistoricoClasificacionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ItemHistoricoClasificacion::class);
    }

//    /**
//     * @return ItemHistoricoClasificacion[] Returns an array of ItemHistoricoClasificacion objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemHistoricoClasificacion
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
