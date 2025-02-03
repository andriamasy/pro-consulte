<?php

namespace App\Application\UseCase\Call;

use App\Domain\Entity\Appel;
use App\Infrastructure\Repository\AppelRepository;

class ListUseCase
{
    public function __construct(
        private readonly AppelRepository $appelRepository,
    ) {
    }

    /**
     * Récupère tous les appels .
     *
     * @return Appel[] La liste des psychologues
     */
    public function execute(): array
    {
        return $this->appelRepository->findAll();
    }
}
