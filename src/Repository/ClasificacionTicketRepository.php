<?php

namespace App\Repository;

use App\Entity\ClasificacionTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClasificacionTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasificacionTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasificacionTicket[]    findAll()
 * @method ClasificacionTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasificacionTicketRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClasificacionTicket::class);
    }

//    /**
//     * @return ClasificacionTicket[] Returns an array of ClasificacionTicket objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClasificacionTicket
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
