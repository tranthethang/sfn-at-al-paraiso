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
use Owp\Sfn\Trait\SlugableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: ReservationStatusCatalogRepository::class)]
class ReservationStatusCatalog implements IReservationStatusCatalog, Identity, Timestampable
{
    use TimestampableEntity;
    use SlugableEntity;

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
    private Collection $reservationStatusCatalog;

    #[ORM\OneToMany(mappedBy: 'reservationStatusCatalog', targetEntity: ReservationStatusEvent::class)]
    private Collection $reservationStatusEvents;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['statusName'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->reservationStatusCatalog = new ArrayCollection();
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
    public function getReservationStatusCatalog(): Collection
    {
        return $this->reservationStatusCatalog;
    }

    public function addDescription(ReservationStatusEvent $description): self
    {
        if (!$this->reservationStatusCatalog->contains($description)) {
            $this->reservationStatusCatalog->add($description);
            $description->setReservationStatusCatalog($this);
        }

        return $this;
    }

    public function removeDescription(ReservationStatusEvent $description): self
    {
        if ($this->reservationStatusCatalog->removeElement($description)) {
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
