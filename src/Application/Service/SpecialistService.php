<?php

namespace App\Application\Service;

use App\Application\DTO\SpecialistDTO;
use App\Application\UseCase\Specialist\DetailsUseCase;
use App\Application\UseCase\Specialist\ListUseCase;
use App\Application\UseCase\Specialist\StoreUseCase;
use App\Domain\Entity\Specialist;
use Exception;

class SpecialistService
{
    public function __construct(
        private readonly ListUseCase $specialistsUseCase,
        private readonly DetailsUseCase $specialistDetailsUseCase,
        private readonly StoreUseCase $specialistStoreUseCase
    ) {
    }

    /**
     * Exécute le cas d'utilisation de l'affichage de la liste des psychologues,
     * triée par statut "En ligne" en premier.
     *
     * @return SpecialistDTO[] La liste des psychologues triée
     */
    public function getAll(): array
    {
        // Récupérer tous les psychologues, triés selon leur statut
        $specialists = $this->specialistsUseCase->execute();

        // Convertir les entités en DTO pour la présentation
        return array_map(
            fn ($specialist) => new SpecialistDTO(
                firstName: $specialist->getFirstName(),
                lastName: $specialist->getLastName(),
                code: $specialist->getCode(),
                email: $specialist->getEmail(),
                id: $specialist->getId(),
                online: $specialist->isOnline(),
                active: $specialist->isActive(),
                description: $specialist->getDescription(),
                mobile: $specialist->getMobile(),
                city: $specialist->getCity(),
            ),
            $specialists
        );
    }

    /**
     * Récupère les détails d'un psychologue par son ID.
     */
    public function getDetail(int $id): ?SpecialistDTO
    {
        $specialist = $this->specialistDetailsUseCase->execute($id);

        return new SpecialistDTO(
            firstName: $specialist->getFirstName(),
            lastName: $specialist->getLastName(),
            code: $specialist->getCode(),
            email: $specialist->getEmail(),
            id: $specialist->getId(),
            online: $specialist->isOnline(),
            active: $specialist->isActive(),
            description: $specialist->getDescription(),
            mobile: $specialist->getMobile(),
            city: $specialist->getCity(),
        );
    }

    /**
     * @throws Exception
     */
    public function store(Specialist $specialist): void
    {
        $specialist = new SpecialistDTO(
            firstName: $specialist->getFirstName(),
            lastName: $specialist->getLastName(),
            code: $specialist->getCode(),
            email: $specialist->getEmail(),
            online: $specialist->isOnline(),
            active: $specialist->isActive(),
            description: $specialist->getDescription(),
            mobile: $specialist->getMobile(),
            city: $specialist->getCity(),
        );

        $this->specialistStoreUseCase->execute($specialist);
    }
}
