<?php

namespace App\Repository;

use App\Entity\Formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formation[]    findAll()
 * @method Formation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formation::class);
    }

    // /**
    //  * @return Formation[] Returns an array of Formation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneByNom($nomFormation): ?Formation
    {
      // Récupérer le gestionnaire d'entité
      $entityManager = $this->getEntityManager();

      // Construction de la requêtemp
       $requete = $entityManager->createQuery(
         'SELECT f
          FROM App\Entity\Formation f
          WHERE f.titre = :nomFormation'
       );

       $requete ->setParameter('nomFormation', $nomFormation);

      // Exécuter la requête et retourner les résultats
      return $requete->getOneOrNullResult();
    }

}
