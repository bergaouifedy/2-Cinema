<?php

namespace App\Repository;

use App\Entity\Annonces;
use App\Entity\categorie;

use App\Entity\RechercheAnnonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annonces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonces[]    findAll()
 * @method Annonces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnoncesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonces::class);
    }

    public function findAllWithPagination(RechercheAnnonce $search) :Query {
        $query = $this->findAllAnnonces();
        
        if ($search->getMaxPrix())
        {
            $query = $query
            ->where('a.Prix <= :MaxPrix')
            ->setParameter('MaxPrix', $search->getMaxPrix());
        }
        if ($search->getVille())
        {
            $query = $query
            ->andWhere('a.ville = :ville')
            ->setParameter('ville', $search->getVille());
        }
        if ($search->getCategory())
        {
            $query = $query
            ->innerJoin('a.categorie','c')
            ->andWhere('c = :categorie')
            ->setParameter('categorie', $search->getCategory());
        }
        return $query->getQuery();
    }

    public function findAllAnnonces():QueryBuilder
    {
        return $this->createQueryBuilder('a');
    }

    public function findAvis(int $idAnnonce): array
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT av
            FROM App\Entity\Avis av
            WHERE av.annonces = :idAnnonce'
        )->setParameter('idAnnonce', $idAnnonce);

        // returns an array of Product objects
        return $query->getResult();
    }


    public function findFavori(int $idUser): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\Annonces a, App\Entity\Favori f
            WHERE a.id = f.annonce
            AND f.User = :idUser'
        )->setParameter('idUser', $idUser);

        // returns an array of Product objects
        return $query->getResult();
    }

    // /**
    //  * @return Annonces[] Returns an array of Annonces objects
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
    public function findOneBySomeField($value): ?Annonces
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
