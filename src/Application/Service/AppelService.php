<?php

namespace App\Application\Service;

use _PHPStan_a54cdb067\Nette\Utils\DateTime;
use App\Application\DTO\AppelDTO;
use App\Application\UseCase\Call\ListUseCase;
use App\Application\UseCase\Call\StoreUseCase;
use App\Infrastructure\Repository\SpecialistRepository;
use DateMalformedStringException;
use Exception;

class AppelService
{
    public function __construct(
        private readonly StoreUseCase $storeUseCase,
        private readonly SpecialistRepository $specialistRepository,
        private readonly ListUseCase $listUseCase,
    ) {
    }

    /**
     * @throws DateMalformedStringException
     * @throws Exception
     */
    public function store(array $data): void
    {

        try {
            $specialist = $this->specialistRepository->find($data['specialist_id']);

            if (!$specialist) {
                throw new Exception('Specialist not found');
            }

            $appel = new AppelDTO(
                date : new DateTime(),
                specialist: $specialist
            );

            $this->storeUseCase->execute($appel);
        } catch (Exception $e) {
            throw new Exception('An error occurred while trying to create an appel');
        }
    }

    /**
     * @throws Exception
     *
     * @return AppelDTO[] La liste des psychologues triée
     */
    public function findAll(): array
    {

        try {
            // Récupérer tous les apples
            $appels = $this->listUseCase->execute();

            // Convertir les entités en DTO pour la présentation
            return array_map(
                fn ($appel) => new AppelDTO(
                    date: $appel->getDate(),
                    specialist: $appel->getSpecialist(),
                    id: $appel->getId()
                ),
                $appels
            );
        } catch (Exception $e) {
            throw new Exception('An error occurred while trying to list an appel');
        }
    }
}
