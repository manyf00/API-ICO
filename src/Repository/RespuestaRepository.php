<?php

namespace App\Repository;

use App\Entity\Respuesta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Respuesta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Respuesta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Respuesta[]    findAll()
 * @method Respuesta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RespuestaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Respuesta::class);
        $this->manager = $manager;
    }

    public function postRespuesta($user,$pregunta,$respuesta)
    {
        $newRespuesta = new Respuesta();

        $newRespuesta
            ->setPregunta($pregunta)
            ->setUsuario($user)
            ->setTexto($respuesta)
            ->setFecha(new \DateTime());
        $this->manager->persist($newRespuesta);
        $this->manager->flush();
    }

    // /**
    //  * @return Respuesta[] Returns an array of Respuesta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Respuesta
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
