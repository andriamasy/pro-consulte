<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Appel;

interface AppelRepositoryInterface
{
    /**
     * Enregistrer un appel.
     */
    public function save(Appel $appel): Appel;
}
