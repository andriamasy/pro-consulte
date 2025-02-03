<?php

namespace App\Domain\Entity;

use App\Infrastructure\Repository\AppelRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppelRepository::class)]
class Appel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity: Specialist::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Specialist $specialist;

    // Getters et Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSpecialist(): Specialist
    {
        return $this->specialist;
    }

    public function setSpecialist(Specialist $specialist): self
    {
        $this->specialist = $specialist;

        return $this;
    }
}
