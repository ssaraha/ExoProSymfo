<?php

namespace App\Repository;

use App\Entity\Transfer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transfer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transfer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transfer[]    findAll()
 * @method Transfer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transfer::class);
    }

    // /**
    //  * @return Transfer[] Returns an array of Transfer objects
    //  */
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
    public function findOneBySomeField($value): ?Transfer
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function searchTransfer($data)
    {
        $query = $this->createQueryBuilder('t')
                      ->select('t', 'c', 'cl', 'p')
                      ->join('t.from_club', 'c')
                      ->join('t.to_club', 'cl')
                      ->join('t.player', 'p');


        if ( !empty($data->firstname) ) {
            $query = $query->andWhere('p.firstname LIKE :firstname')
                           ->setParameter('firstname', "%{$data->firstname}%");
        }

        if( !empty($data->lastname) )
        {
            $query = $query->andWhere('p.lastname LIKE :lastname')
                           ->setParameter('lastname', "%{$data->lastname}%");
        }

        if( !empty($data->season) )
        {
            $query = $query->andWhere('t.season =:season')
                           ->setParameter('season', $data->season);
        }
        if( !empty($data->from_club) )
        {
            $query = $query->andWhere('t.from_club =:club')
                           ->setParameter('club', $data->from_club);
        }
        if( !empty($data->to_club) )
        {
            $query = $query->andWhere('t.to_club =:club')
                           ->setParameter('club', $data->to_club);
        }

        if( !empty($data->min_price) )
        {
            $query = $query->andWhere('t.price >= :min_price')
                           ->setParameter('min_price', $data->min_price);
        }

        if( !empty($data->max_price) )
        {
            $query = $query->andWhere('t.price <= :max_price')
                           ->setParameter('max_price', $data->max_price);
        }

        if( !empty($data->max_price) && !empty($data->max_price) )
        {
            $query = $query->andWhere('t.price BETWEEN :min_price AND :max_price')
                           ->setParameter('min_price', $data->min_price)
                           ->setParameter('max_price', $data->max_price);
        }
        //dd('ici');

        return $query->getQuery()->getResult();
        //return $query->getQuery()->getResult();
    }
}
