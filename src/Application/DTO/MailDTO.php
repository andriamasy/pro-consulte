<?php

namespace App\Application\DTO;

use App\Domain\Entity\Specialist;
use DateTimeInterface;

class MailDTO
{
    public function __construct(
        public DateTimeInterface $date,
        public Specialist $specialist,
        public string $subject,
        public string $content,
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

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
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
