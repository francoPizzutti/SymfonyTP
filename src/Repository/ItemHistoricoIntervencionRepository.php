<?php

namespace App\Repository;

use App\Entity\ItemHistoricoIntervencion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ItemHistoricoIntervencion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemHistoricoIntervencion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemHistoricoIntervencion[]    findAll()
 * @method ItemHistoricoIntervencion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemHistoricoIntervencionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ItemHistoricoIntervencion::class);
    }

//    /**
//     * @return ItemHistoricoIntervencion[] Returns an array of ItemHistoricoIntervencion objects
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
    public function findOneBySomeField($value): ?ItemHistoricoIntervencion
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
