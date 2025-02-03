<?php

namespace App\Application\UseCase\Call;

use App\Application\DTO\AppelDTO;
use App\Domain\Entity\Appel;
use App\Infrastructure\Repository\AppelRepository;
use Exception;

class StoreUseCase
{
    public function __construct(
        private readonly AppelRepository $appelRepository,
    ) {
    }

    /**
     * store appel.
     *
     * @throws Exception
     */
    public function execute(AppelDTO $dto): Appel
    {
        try {
            // Création du psychologue
            $appel = new Appel();
            $appel->setDate($dto->date);
            $appel->setSpecialist($dto->specialist);

            // Sauvegarde en base de données
            return $this->appelRepository->save($appel);
        } catch (Exception $exception) {
            throw new Exception('An error occurred while saving appel');
        }
    }
}
