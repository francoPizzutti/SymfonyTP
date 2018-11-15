<?php

namespace App\Repository;

use App\Entity\Ticket;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

//    /**
//     * @return Ticket[] Returns an array of Ticket objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ticket
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function lastT(): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->setMaxResults(1);

        return $qb->execute();

        // to get just one result:
        // $product = $qb->setMaxResults(1)->getOneOrNullResult();
    }

    public function consult($idticket, $empleado, $fecha): array
    {

        $entityManager = $this->getEntityManager();

        $qb = $this->createQueryBuilder('t');
        if($idticket!=null){
            $qb->setParameter('id', $idticket)
                ->where('t.id = :id');

        }
        if($empleado!=null){
            $qb ->setParameter('e', $empleado)

                ->andWhere('t.Empleado = :e');
        }
        if($fecha!=null){
            $fechafloor = new datetime(''.$fecha.'00:00:00');
            $fechaceil = new datetime(''.$fecha.'23:59:59');
            $qb ->setParameter('ff', $fechafloor)
                ->setParameter('fc', $fechaceil)
                ->andWhere('t.Fecha < :fc')
                ->andWhere('t.Fecha > :ff');
        }

            return $qb->getQuery()->execute();


    }
}
