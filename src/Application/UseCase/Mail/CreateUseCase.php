<?php

namespace App\Application\UseCase\Mail;

use App\Application\DTO\MailDTO;
use App\Domain\Entity\Mail;
use App\Infrastructure\Repository\MailRepository;
use Exception;

class CreateUseCase
{
    public function __construct(
        private readonly MailRepository $mailRepository
    ) {
    }

    /**
     * @throws Exception
     */
    public function execute(MailDTO $mailDto): Mail
    {
        try {
            // Création du psychologue
            $mail = new Mail();
            $mail->setSubject($mailDto->getSubject());
            $mail->setContent($mailDto->getContent());
            $mail->setDate($mailDto->getDate());
            $mail->setSpecialist($mailDto->getSpecialist());

            // Sauvegarde en base de données
            return $this->mailRepository->save($mail);
        } catch (Exception $exception) {
            throw new Exception('An error occurred while saving appel');
        }
    }
}
