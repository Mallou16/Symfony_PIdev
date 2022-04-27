<?php

namespace App\Repository;

use App\Entity\Materiel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Materiel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materiel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materiel[]    findAll()
 * @method Materiel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiel::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Materiel $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Materiel $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

     /**
      * @return Materiel[] Returns an array of Materiel objects
     */
    public function findByNom()
    {
        return $this
            ->createQueryBuilder('m')
            ->addOrderBy('m.nom', 'ASC')
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * @return Materiel[] Returns an array of Materiel objects
     */
    public function findByQuantite()
    {
        return $this
            ->createQueryBuilder('m')
            ->addOrderBy('m.quantite', 'ASC')
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * @return Materiel[] Returns an array of Materiel objects
     */
    public function findByPrix()
    {
        return $this
            ->createQueryBuilder('m')
            ->addOrderBy('m.prix', 'DESC')
            ->getQuery()
            ->execute()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Materiel
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
