<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Mail;

interface MailRepositoryInterface
{
    /**
     * Enregistrer un mail.
     */
    public function save(Mail $mail): Mail;
}
