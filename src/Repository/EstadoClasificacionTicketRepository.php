<?php

namespace App\Repository;

use App\Entity\EstadoClasificacionTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EstadoClasificacionTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoClasificacionTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoClasificacionTicket[]    findAll()
 * @method EstadoClasificacionTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoClasificacionTicketRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EstadoClasificacionTicket::class);
    }

//    /**
//     * @return EstadoClasificacionTicket[] Returns an array of EstadoClasificacionTicket objects
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
    public function findOneBySomeField($value): ?EstadoClasificacionTicket
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
