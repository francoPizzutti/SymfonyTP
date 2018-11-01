<?php

namespace App\Repository;

use App\Entity\EstadoTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EstadoTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoTicket[]    findAll()
 * @method EstadoTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoTicketRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EstadoTicket::class);
    }

//    /**
//     * @return EstadoTicket[] Returns an array of EstadoTicket objects
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
    public function findOneBySomeField($value): ?EstadoTicket
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
