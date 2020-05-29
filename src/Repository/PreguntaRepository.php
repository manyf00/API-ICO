<?php

namespace App\Repository;

use App\Entity\Pregunta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Pregunta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pregunta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pregunta[]    findAll()
 * @method Pregunta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreguntaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Pregunta::class);
        $this->manager = $manager;
    }

    public function postPregunta($user, $pregunta)
    {
        $newPregunta = new Pregunta();
        
        $newPregunta
            ->setUsuario($user)
            ->setPregunta($pregunta)
            ->setFecha(new \Date("Y-m-d"));
        $this->manager->persist($newPregunta);
        $this->manager->flush();
    }
    // /**
    //  * @return Pregunta[] Returns an array of Pregunta objects
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
    public function findOneBySomeField($value): ?Pregunta
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
