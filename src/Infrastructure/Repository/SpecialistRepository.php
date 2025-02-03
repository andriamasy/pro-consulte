<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Specialist;
use App\Domain\Repository\SpecialistRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Specialist>
 *
 * @method Specialist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Specialist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Specialist[]    findAll()
 * @method Specialist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialistRepository extends ServiceEntityRepository implements SpecialistRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Specialist::class);
    }

    public function add(Specialist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Specialist $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Récupère tous les psychologues, triés par leur statut "En ligne".
     *
     * @return Specialist[] La liste des psychologues
     */
    public function findAllOrderedByStatus(): array
    {
        return $this->getEntityManager()->getRepository(Specialist::class)
            ->createQueryBuilder('s')
            ->orderBy('s.online', 'DESC')  // En ligne d'abord
            ->getQuery()
            ->getResult();
    }

    /**
     * enregistrer un psychologue.
     */
    public function save(Specialist $specialist): Specialist
    {
        $this->getEntityManager()->persist($specialist);
        $this->getEntityManager()->flush();

        return $specialist;
    }
}
