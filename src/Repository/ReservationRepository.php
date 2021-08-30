<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

   

    public function findEtatReservation(int $idUser,int $idAnnonce): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT r.etat
            FROM App\Entity\Reservation r
            WHERE r.client = :idUser
            And r.annonce= :idAnnonce'
        )->setParameter('idUser' , $idUser )
        ->setParameter('idAnnonce', $idAnnonce);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function findReservationParClient($idUser)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT r
            FROM App\Entity\Reservation r
            WHERE r.loueur = :idUser'
                    )->setParameter('idUser' , $idUser );

        // returns an array of Product objects
        return $query->getResult();
    }

   public function findReservationAcceptee($idUser)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT r
            FROM App\Entity\Reservation r
            WHERE r.loueur = :idUser
            AND r.etat LIKE :Reservation 
            ')         
            
            ->setParameter('idUser' , $idUser )
            ->setParameter('Reservation' , 'Reservation acceptée' );

        // returns an array of Product objects
        return $query->getResult();

    }


   /* public function findReservationAcceptee($idUser)
    {
        $query = $this->findAllReservations();
        $query = $query
        ->where('r.loueur = :idUser' )
        ->setParameter('idUser' , $idUser )
    
        ;
        return $query->getQuery();


    }*/
    
    public function findAllReservations():QueryBuilder
    {
        return $this->createQueryBuilder('r');
    }

    public function findReservation(int $idUser,$idAnnonce)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT r
            FROM App\Entity\Reservation r
            WHERE r.client = :idUser
            And r.annonce= :idAnnonce'
        )->setParameter('idUser' , $idUser)
        ->setParameter('idAnnonce', $idAnnonce);


        // returns an array of Product objects
        return $query->getResult();
    }
    
    public function findReservationParAnnonce($idAnnonce)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT r
            FROM App\Entity\Reservation r
            WHERE r.annonce= :idAnnonce'
        )
        ->setParameter('idAnnonce', $idAnnonce);


        // returns an array of Product objects
        return $query->getResult();
    }
    

    // /**
    //  * @return Reservation[] Returns an array of Reservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reservation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
