<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Mail;
use App\Domain\Repository\MailRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mail>
 *
 * @method Mail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mail[]    findAll()
 * @method Mail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * */
class MailRepository extends ServiceEntityRepository implements MailRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mail::class);
    }

    public function save(Mail $mail): Mail
    {
        $this->getEntityManager()->persist($mail);
        $this->getEntityManager()->flush();

        return $mail;
    }
}
