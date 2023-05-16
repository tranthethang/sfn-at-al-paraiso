<?php

namespace App\Entity;

use App\Repository\ChannelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Owp\Sfn\Trait\SlugableEntity;

#[ORM\Entity(repositoryClass: ChannelRepository::class)]
class Channel
{
    use TimestampableEntity;
    use SlugableEntity;

    public function __toString(): string
    {
        return $this->getChannelName();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $channelName = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['channelName'])]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'channel', targetEntity: ChannelUsed::class)]
    private Collection $channelUseds;

    #[ORM\OneToMany(mappedBy: 'channel', targetEntity: Synchronization::class)]
    private Collection $synchronizations;

    public function __construct()
    {
        $this->channelUseds = new ArrayCollection();
        $this->synchronizations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannelName(): ?string
    {
        return $this->channelName;
    }

    public function setChannelName(string $channelName): self
    {
        $this->channelName = $channelName;

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
            $channelUsed->setChannel($this);
        }

        return $this;
    }

    public function removeChannelUsed(ChannelUsed $channelUsed): self
    {
        if ($this->channelUseds->removeElement($channelUsed)) {
            // set the owning side to null (unless already changed)
            if ($channelUsed->getChannel() === $this) {
                $channelUsed->setChannel(null);
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
            $synchronization->setChannel($this);
        }

        return $this;
    }

    public function removeSynchronization(Synchronization $synchronization): self
    {
        if ($this->synchronizations->removeElement($synchronization)) {
            // set the owning side to null (unless already changed)
            if ($synchronization->getChannel() === $this) {
                $synchronization->setChannel(null);
            }
        }

        return $this;
    }
}
