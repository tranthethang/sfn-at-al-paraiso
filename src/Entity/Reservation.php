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

    public function __construct()
    {
        $this->reservationStatusEvents = new ArrayCollection();
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
}
