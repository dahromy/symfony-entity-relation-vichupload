<?php

namespace App\Repository;

use App\Entity\InvoiceAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InvoiceAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvoiceAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvoiceAttachment[]    findAll()
 * @method InvoiceAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvoiceAttachment::class);
    }

    // /**
    //  * @return InvoiceAttachment[] Returns an array of InvoiceAttachment objects
    //  */
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
    public function findOneBySomeField($value): ?InvoiceAttachment
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
