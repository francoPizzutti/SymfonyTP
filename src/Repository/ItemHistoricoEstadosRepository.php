<?php

namespace App\Repository;

use App\Entity\ItemHistoricoEstados;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ItemHistoricoEstados|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemHistoricoEstados|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemHistoricoEstados[]    findAll()
 * @method ItemHistoricoEstados[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemHistoricoEstadosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ItemHistoricoEstados::class);
    }

//    /**
//     * @return ItemHistoricoEstados[] Returns an array of ItemHistoricoEstados objects
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
    public function findOneBySomeField($value): ?ItemHistoricoEstados
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
