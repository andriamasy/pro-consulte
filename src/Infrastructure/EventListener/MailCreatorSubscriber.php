<?php

namespace App\Infrastructure\EventListener;

use App\Application\Service\MailService;
use App\Domain\Entity\Specialist;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostPersistEventArgs;

#[AsDoctrineListener(event: 'postPersist')]
class MailCreatorSubscriber
{
    public function __construct(private readonly MailService $mailService)
    {
    }

    public function postPersist(PostPersistEventArgs $event): void
    {
        $entity = $event->getObject();

        if ($entity instanceof Specialist) {
            $this->mailService->store($entity);
        }
    }
}
