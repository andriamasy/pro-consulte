<?php

namespace App\Application\UseCase\Specialist;

use App\Application\DTO\SpecialistDTO;
use App\Domain\Entity\Specialist;
use App\Domain\Repository\SpecialistRepositoryInterface;
use Exception;

class StoreUseCase
{
    public function __construct(
        private readonly SpecialistRepositoryInterface $specialistRepository,
    ) {
    }

    /**
     * store psychologist.
     *
     * @throws Exception
     */
    public function execute(SpecialistDTO $dto): Specialist
    {
        try {
            // Création du psychologue
            $specialist = new Specialist();
            $specialist->setFirstName($dto->firstName);
            $specialist->setLastName($dto->lastName);
            $specialist->setEmail($dto->email);
            $specialist->setMobile($dto->mobile);
            $specialist->setOnline($dto->online);
            $specialist->setActive(true);
            $specialist->setCity($dto->city);
            $specialist->setDescription($dto->description);
            $specialist->setCode($dto->getCode());

            // Sauvegarde en base de données
            return $this->specialistRepository->save($specialist);
        } catch (Exception $exception) {
            throw new Exception('An error occurred while saving psychologist');
        }
    }
}
