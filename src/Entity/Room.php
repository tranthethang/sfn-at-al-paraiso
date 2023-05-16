<?php

namespace App\Entity;

use App\Contract\Entity\IRoom;
use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Owp\Sfn\Contract\Field\Description;
use Owp\Sfn\Contract\Field\Identity;
use Owp\Sfn\Contract\Field\Timestampable;
use Owp\Sfn\Trait\SlugableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room implements IRoom, Identity, Description, Timestampable
{
    use TimestampableEntity;
    use SlugableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $roomName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    private ?Hotel $hotel = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    private ?RoomType $roomType = null;

    #[ORM\Column]
    private ?int $currentPrice = null;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: ChannelUsed::class)]
    private Collection $channelUseds;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: RoomReserved::class)]
    private Collection $roomReserveds;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['roomName'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->channelUseds = new ArrayCollection();
        $this->roomReserveds = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ChannelUsed>
     */
    public function getChannelUseds(): Collection
    {
        return $this->channelUseds;
    }

    public function addChannelUsed(ChannelUsed $channelUsed): self
    {
        if (!$this->channelUseds->contains($channelUsed)) {
            $this->channelUseds->add($channelUsed);
            $channelUsed->setRoom($this);
        }

        return $this;
    }

    public function removeChannelUsed(ChannelUsed $channelUsed): self
    {
        if ($this->channelUseds->removeElement($channelUsed)) {
            // set the owning side to null (unless already changed)
            if ($channelUsed->getRoom() === $this) {
                $channelUsed->setRoom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RoomReserved>
     */
    public function getRoomReserveds(): Collection
    {
        return $this->roomReserveds;
    }

    public function addRoomReserved(RoomReserved $roomReserved): self
    {
        if (!$this->roomReserveds->contains($roomReserved)) {
            $this->roomReserveds->add($roomReserved);
            $roomReserved->setRoom($this);
        }

        return $this;
    }

    public function removeRoomReserved(RoomReserved $roomReserved): self
    {
        if ($this->roomReserveds->removeElement($roomReserved)) {
            // set the owning side to null (unless already changed)
            if ($roomReserved->getRoom() === $this) {
                $roomReserved->setRoom(null);
            }
        }

        return $this;
    }
}
