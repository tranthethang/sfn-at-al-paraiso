<?php

namespace App\Entity;

use App\Contract\Entity\IReservationStatusCatalog;
use App\Repository\ReservationStatusCatalogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Owp\Sfn\Contract\Field\Identity;
use Owp\Sfn\Contract\Field\Timestampable;

#[ORM\Entity(repositoryClass: ReservationStatusCatalogRepository::class)]
class ReservationStatusCatalog implements IReservationStatusCatalog, Identity, Timestampable
{
    use TimestampableEntity;

    public function __toString(): string
    {
        return $this->getStatusName();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statusName = null;

    #[ORM\OneToMany(mappedBy: 'reservationStatusCatalog', targetEntity: ReservationStatusEvent::class)]
    private Collection $description;

    #[ORM\OneToMany(mappedBy: 'reservationStatusCatalog', targetEntity: ReservationStatusEvent::class)]
    private Collection $reservationStatusEvents;

    public function __construct()
    {
        $this->description = new ArrayCollection();
        $this->reservationStatusEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusName(): ?string
    {
        return $this->statusName;
    }

    public function setStatusName(string $statusName): self
    {
        $this->statusName = $statusName;

        return $this;
    }

    /**
     * @return Collection<int, ReservationStatusEvent>
     */
    public function getDescription(): Collection
    {
        return $this->description;
    }

    public function addDescription(ReservationStatusEvent $description): self
    {
        if (!$this->description->contains($description)) {
            $this->description->add($description);
            $description->setReservationStatusCatalog($this);
        }

        return $this;
    }

    public function removeDescription(ReservationStatusEvent $description): self
    {
        if ($this->description->removeElement($description)) {
            // set the owning side to null (unless already changed)
            if ($description->getReservationStatusCatalog() === $this) {
                $description->setReservationStatusCatalog(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReservationStatusEvent>
     */
    public function getReservationStatusEvents(): Collection
    {
        return $this->reservationStatusEvents;
    }

    public function addReservationStatusEvent(ReservationStatusEvent $reservationStatusEvent): self
    {
        if (!$this->reservationStatusEvents->contains($reservationStatusEvent)) {
            $this->reservationStatusEvents->add($reservationStatusEvent);
            $reservationStatusEvent->setReservationStatusCatalog($this);
        }

        return $this;
    }

    public function removeReservationStatusEvent(ReservationStatusEvent $reservationStatusEvent): self
    {
        if ($this->reservationStatusEvents->removeElement($reservationStatusEvent)) {
            // set the owning side to null (unless already changed)
            if ($reservationStatusEvent->getReservationStatusCatalog() === $this) {
                $reservationStatusEvent->setReservationStatusCatalog(null);
            }
        }

        return $this;
    }
}
