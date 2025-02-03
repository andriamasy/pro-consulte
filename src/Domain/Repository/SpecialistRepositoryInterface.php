<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Specialist;

interface SpecialistRepositoryInterface
{
    /**
     * Ajouter spécialiste.
     */
    public function add(Specialist $entity, bool $flush = false): void;

    /**
     * Récupère tous les psychologues triés par leur statut en ligne.
     *
     * @return Specialist[] La liste des psychologues
     */
    public function findAllOrderedByStatus(): array;

    /**
     * Enregistrer un psychologue.
     */
    public function save(Specialist $specialist): Specialist;
}
