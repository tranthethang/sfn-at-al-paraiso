<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $roomName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    private ?RoomType $roomType = null;

    #[ORM\Column]
    private ?int $currentPrice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomName(): ?string
    {
        return $this->roomName;
    }

    public function setRoomName(string $roomName): self
    {
        $this->roomName = $roomName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getRoomType(): ?RoomType
    {
        return $this->roomType;
    }

    public function setRoomType(?RoomType $roomType): self
    {
        $this->roomType = $roomType;

        return $this;
    }

    public function getCurrentPrice(): ?int
    {
        return $this->currentPrice;
    }

    public function setCurrentPrice(int $currentPrice): self
    {
        $this->currentPrice = $currentPrice;

        return $this;
    }
}
