<?php

namespace App\Entity;

use App\Repository\SynchronizationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: SynchronizationRepository::class)]
class Synchronization
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'synchronizations')]
    private ?Reservation $reservation = null;

    #[ORM\ManyToOne(inversedBy: 'synchronizations')]
    private ?Channel $channel = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $messageSent = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $messageReceived = null;

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

    public function getChannel(): ?Channel
    {
        return $this->channel;
    }

    public function setChannel(?Channel $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getMessageSent(): ?string
    {
        return $this->messageSent;
    }

    public function setMessageSent(string $messageSent): self
    {
        $this->messageSent = $messageSent;

        return $this;
    }

    public function getMessageReceived(): ?string
    {
        return $this->messageReceived;
    }

    public function setMessageReceived(?string $messageReceived): self
    {
        $this->messageReceived = $messageReceived;

        return $this;
    }
}
