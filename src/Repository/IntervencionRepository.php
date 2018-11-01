<?php

namespace App\Repository;

use App\Entity\Intervencion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Intervencion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intervencion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intervencion[]    findAll()
 * @method Intervencion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntervencionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Intervencion::class);
    }

//    /**
//     * @return Intervencion[] Returns an array of Intervencion objects
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
    public function findOneBySomeField($value): ?Intervencion
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
