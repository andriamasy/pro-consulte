<?php

namespace App\Application\UseCase\Specialist;

use App\Domain\Entity\Specialist;
use App\Domain\Repository\SpecialistRepositoryInterface;

class ListUseCase
{
    public function __construct(
        private readonly SpecialistRepositoryInterface $specialistRepository,
    ) {
    }

    /**
     * Récupère tous les psychologues triés par statut en ligne.
     *
     * @return Specialist[] La liste des psychologues
     */
    public function execute(): array
    {
        return $this->specialistRepository->findAllOrderedByStatus();
    }
}
