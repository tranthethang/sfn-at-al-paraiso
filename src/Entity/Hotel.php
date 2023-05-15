<?php

namespace App\Entity;

use App\Contract\Entity\IHotel;
use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Timestampable;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Owp\Sfn\Contract\Field\ActiveState;
use Owp\Sfn\Contract\Field\Description;
use Owp\Sfn\Contract\Field\Identity;
use Gedmo\Mapping\Annotation as Gedmo;
use Owp\Sfn\Trait\SlugableEntity;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel implements IHotel, Identity, Description, ActiveState, Timestampable
{
    use TimestampableEntity;
    use SlugableEntity;

    public function __toString(): string
    {
        return $this->getHotelName();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $hotelName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'hotels')]
    private ?Category $category = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\OneToMany(mappedBy: 'hotel', targetEntity: Room::class)]
    private Collection $rooms;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['hotelName'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHotelName(): ?string
    {
        return $this->hotelName;
    }

    public function setHotelName(string $hotelName): self
    {
        $this->hotelName = $hotelName;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
            $room->setHotel($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getHotel() === $this) {
                $room->setHotel(null);
            }
        }

        return $this;
    }
}
