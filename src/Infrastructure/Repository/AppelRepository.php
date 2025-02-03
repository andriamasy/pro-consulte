<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Appel;
use App\Domain\Repository\AppelRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Appel>
 *
 * @method Appel|null find($id, mixed $lockMode = null, mixed $lockVersion = null)
 * @method Appel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appel[]    findAll()
 * @method Appel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppelRepository extends ServiceEntityRepository implements AppelRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appel::class);
    }

    public function save(Appel $appel): Appel
    {
        $this->getEntityManager()->persist($appel);
        $this->getEntityManager()->flush();

        return $appel;
    }
}
