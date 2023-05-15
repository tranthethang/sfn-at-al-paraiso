<?php

namespace App\Entity;

use App\Contract\Entity\ICategory;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Owp\Sfn\Contract\Field\Identity;
use Owp\Sfn\Contract\Field\Timestampable;
use Gedmo\Mapping\Annotation as Gedmo;
use Owp\Sfn\Trait\SlugableEntity;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements ICategory, Identity, Timestampable
{
    use TimestampableEntity;
    use SlugableEntity;

    public function __toString(): string
    {
        return $this->getCategoryName();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $categoryName = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Hotel::class)]
    private Collection $hotels;

    #[ORM\Column(length: 255, unique: true)]
    #[Gedmo\Slug(fields: ['categoryName'])]
    private ?string $slug = null;

    public function __construct()
    {
        $this->hotels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @return Collection<int, Hotel>
     */
    public function getHotels(): Collection
    {
        return $this->hotels;
    }

    public function addHotel(Hotel $hotel): self
    {
        if (!$this->hotels->contains($hotel)) {
            $this->hotels->add($hotel);
            $hotel->setCategory($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): self
    {
        if ($this->hotels->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getCategory() === $this) {
                $hotel->setCategory(null);
            }
        }

        return $this;
    }
}
