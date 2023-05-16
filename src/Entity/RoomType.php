<?php

namespace App\Entity;

use App\Contract\Entity\IRoomType;
use App\Repository\RoomTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Owp\Sfn\Contract\Field\Description;
use Owp\Sfn\Contract\Field\Identity;
use Owp\Sfn\Contract\Field\Timestampable;
use Gedmo\Mapping\Annotation as Gedmo;
use Owp\Sfn\Trait\SlugableEntity;

#[ORM\Entity(repositoryClass: RoomTypeRepository::class)]
class RoomType implements IRoomType, Description, Identity, Timestampable
{
    use TimestampableEntity;
    use SlugableEntity;

    public function __toString(): string
    {
        return $this->getTypeName();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeName = null;

    #[ORM\OneToMany(mappedBy: 'roomType', targetEntity: Room::class)]
    private Collection $rooms;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['typeName'])]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    public function setTypeName(string $typeName): self
    {
        $this->typeName = $typeName;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->setRoomType($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getRoomType() === $this) {
                $room->setRoomType(null);
            }
        }

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
}
