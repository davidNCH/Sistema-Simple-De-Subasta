<?php

namespace App\Repository;

use App\Entity\Comprador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comprador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comprador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comprador[]    findAll()
 * @method Comprador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompradorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comprador::class);
    }
    public function Buscartodoloscomprador()
    {
      // return $this->getEntityManager()
        //    ->createQuery('
          //  SELECT user.id, user.nombre
            //From App:Comprador comprador
            //JOIN comprador.user user');
    }


    /*
    public function findOneBySomeField($value): ?Comprador
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
