<?php

namespace App\Application\DTO;

use App\Domain\Entity\Specialist;
use DateTimeInterface;

class AppelDTO
{
    public function __construct(
        public DateTimeInterface $date,
        public Specialist $specialist,
        public ?int $id = null,
    ) {
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    public function getSpecialist(): Specialist
    {
        return $this->specialist;
    }

    public function setSpecialist(Specialist $specialist): void
    {
        $this->specialist = $specialist;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
