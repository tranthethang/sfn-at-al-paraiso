<?php

namespace App\Entity;

use App\Contract\Entity\IReservation;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Owp\Sfn\Contract\Field\Identity;
use Owp\Sfn\Contract\Field\Timestampable;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation implements IReservation, Identity, Timestampable
{
    use TimestampableEntity;

    public function __toString(): string
    {
        return sprintf("%s (%s-%s)", $this->getGuest(), $this->getStartDate()->format('d/m/Y'), $this->getEndDate()->format('d/m/Y'));
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Guest $guest = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(nullable: true)]
    private ?float $discountPercent = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalPrice = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: ReservationStatusEvent::class)]
    private Collection $reservationStatusEvents;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Synchronization::class)]
    private Collection $synchronizations;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: RoomReserved::class)]
    private Collection $roomReserveds;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: InvoiceGuest::class)]
    private Collection $invoiceGuests;

    public function __construct()
    {
        $this->reservationStatusEvents = new ArrayCollection();
        $this->synchronizations = new ArrayCollection();
        $this->roomReserveds = new ArrayCollection();
        $this->invoiceGuests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getDiscountPercent(): ?float
    {
        return $this->discountPercent;
    }

    public function setDiscountPercent(?float $discountPercent): self
    {
        $this->discountPercent = $discountPercent;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

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
            $reservationStatusEvent->setReservation($this);
        }

        return $this;
    }

    public function removeReservationStatusEvent(ReservationStatusEvent $reservationStatusEvent): self
    {
        if ($this->reservationStatusEvents->removeElement($reservationStatusEvent)) {
            // set the owning side to null (unless already changed)
            if ($reservationStatusEvent->getReservation() === $this) {
                $reservationStatusEvent->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Synchronization>
     */
    public function getSynchronizations(): Collection
    {
        return $this->synchronizations;
    }

    public function addSynchronization(Synchronization $synchronization): self
    {
        if (!$this->synchronizations->contains($synchronization)) {
            $this->synchronizations->add($synchronization);
            $synchronization->setReservation($this);
        }

        return $this;
    }

    public function removeSynchronization(Synchronization $synchronization): self
    {
        if ($this->synchronizations->removeElement($synchronization)) {
            // set the owning side to null (unless already changed)
            if ($synchronization->getReservation() === $this) {
                $synchronization->setReservation(null);
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
            $roomReserved->setReservation($this);
        }

        return $this;
    }

    public function removeRoomReserved(RoomReserved $roomReserved): self
    {
        if ($this->roomReserveds->removeElement($roomReserved)) {
            // set the owning side to null (unless already changed)
            if ($roomReserved->getReservation() === $this) {
                $roomReserved->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InvoiceGuest>
     */
    public function getInvoiceGuests(): Collection
    {
        return $this->invoiceGuests;
    }

    public function addInvoiceGuest(InvoiceGuest $invoiceGuest): self
    {
        if (!$this->invoiceGuests->contains($invoiceGuest)) {
            $this->invoiceGuests->add($invoiceGuest);
            $invoiceGuest->setReservation($this);
        }

        return $this;
    }

    public function removeInvoiceGuest(InvoiceGuest $invoiceGuest): self
    {
        if ($this->invoiceGuests->removeElement($invoiceGuest)) {
            // set the owning side to null (unless already changed)
            if ($invoiceGuest->getReservation() === $this) {
                $invoiceGuest->setReservation(null);
            }
        }

        return $this;
    }
}
