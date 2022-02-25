<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Data\SearchPlayerData;
/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function findSearch(SearchPlayerData $searchPlayerData):array
    {
        $query = $this->createQueryBuilder('p')
                      ->select('p', 'c', 'po')
                      ->join('p.club', 'c')
                      ->join('p.poste', 'po');
        if ( !empty($query->getQuery()->getResult()) ) {
            $query = $query->andWhere('p.firstname LIKE :firstname')
                           ->setParameter('firstname', "%{$searchPlayerData->firstname}%");

        }
        //dd($query);
        if ( !empty($searchPlayerData->lastname) ) {
            $query = $query->andWhere('p.lastname LIKE :lastname')
                           ->setParameter('lastname', "%{$searchPlayerData->lastname}%");

        }
        if( !empty($searchPlayerData->club) )
        {
            $query = $query->andWhere('c.id IN (:clubs)')
                           ->setParameter('clubs', $searchPlayerData->club);
        }
        if( !empty($searchPlayerData->poste) )
        {
            $query = $query->andWhere('po.id IN (:postes)')
                           ->setParameter('postes', $searchPlayerData->poste);
        }

        
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Player[] Returns an array of Player objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Player
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
