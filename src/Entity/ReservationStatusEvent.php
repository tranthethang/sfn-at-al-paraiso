<?php

namespace App\Entity;

use App\Contract\Entity\IReservationStatusEvent;
use App\Repository\ReservationStatusEventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Owp\Sfn\Contract\Field\Description;
use Owp\Sfn\Contract\Field\Identity;
use Owp\Sfn\Contract\Field\Timestampable;

#[ORM\Entity(repositoryClass: ReservationStatusEventRepository::class)]
class ReservationStatusEvent implements IReservationStatusEvent, Identity, Description, Timestampable
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservationStatusEvents')]
    private ?Reservation $reservation = null;

    #[ORM\ManyToOne(inversedBy: 'reservationStatusEvents')]
    private ?ReservationStatusCatalog $reservationStatusCatalog = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getReservationStatusCatalog(): ?ReservationStatusCatalog
    {
        return $this->reservationStatusCatalog;
    }

    public function setReservationStatusCatalog(?ReservationStatusCatalog $reservationStatusCatalog): self
    {
        $this->reservationStatusCatalog = $reservationStatusCatalog;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
