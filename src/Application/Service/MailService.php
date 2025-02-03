<?php

namespace App\Application\Service;

use App\Application\DTO\MailDTO;
use App\Application\UseCase\Mail\CreateUseCase;
use App\Domain\Entity\Specialist;
use DateTime;

class MailService
{
    public function __construct(private readonly CreateUseCase $createUseCase)
    {
    }

    public function store(Specialist $specialist): void
    {
        $subject = sprintf('Nouveau psychologue ajouté : %s %s', $specialist->getFirstName(), $specialist->getLastName());
        $content = "Un nouveau psychologue a été ajouté via l'administration.";

        $mailDto = new MailDTO(
            date : new DateTime(),
            specialist: $specialist,
            subject: $subject,
            content: $content
        );

        $this->createUseCase->execute($mailDto);
    }
}
