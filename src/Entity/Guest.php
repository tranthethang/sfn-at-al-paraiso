<?php

namespace App\Entity;

use App\Contract\Entity\IGuest;
use App\Repository\GuestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Owp\Sfn\Contract\Field\Identity;
use Owp\Sfn\Contract\Field\Timestampable;

#[ORM\Entity(repositoryClass: GuestRepository::class)]
class Guest implements IGuest, Identity, Timestampable
{
    use TimestampableEntity;

    public function __toString(): string
    {
        return sprintf("%s %s", $this->getFirstName(), $this->getLastName());
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $memberSince = null;

    #[ORM\OneToMany(mappedBy: 'guest', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\OneToMany(mappedBy: 'guest', targetEntity: InvoiceGuest::class)]
    private Collection $invoiceGuests;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $citizenIdentityCard = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $permanentAddress = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->invoiceGuests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMemberSince(): ?\DateTimeInterface
    {
        return $this->memberSince;
    }

    public function setMemberSince(\DateTimeInterface $memberSince): self
    {
        $this->memberSince = $memberSince;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setGuest($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getGuest() === $this) {
                $reservation->setGuest(null);
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
            $invoiceGuest->setGuest($this);
        }

        return $this;
    }

    public function removeInvoiceGuest(InvoiceGuest $invoiceGuest): self
    {
        if ($this->invoiceGuests->removeElement($invoiceGuest)) {
            // set the owning side to null (unless already changed)
            if ($invoiceGuest->getGuest() === $this) {
                $invoiceGuest->setGuest(null);
            }
        }

        return $this;
    }

    public function getCitizenIdentityCard(): ?string
    {
        return $this->citizenIdentityCard;
    }

    public function setCitizenIdentityCard(?string $citizenIdentityCard): self
    {
        $this->citizenIdentityCard = $citizenIdentityCard;

        return $this;
    }

    public function getPermanentAddress(): ?string
    {
        return $this->permanentAddress;
    }

    public function setPermanentAddress(?string $permanentAddress): self
    {
        $this->permanentAddress = $permanentAddress;

        return $this;
    }
}
