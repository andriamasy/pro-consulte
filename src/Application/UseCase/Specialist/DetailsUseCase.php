<?php

namespace App\Application\UseCase\Specialist;

use App\Domain\Entity\Specialist;
use App\Infrastructure\Repository\SpecialistRepository;

class DetailsUseCase
{
    public function __construct(
        private readonly SpecialistRepository $specialistRepository
    ) {
    }

    /**
     * Récupère les détails d'un psychologue par son ID.
     */
    public function execute(int $id): ?Specialist
    {
        return $this->specialistRepository->find($id);
    }
}
