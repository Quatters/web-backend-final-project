<?php

namespace App\Entity;

use App\Repository\SomeTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SomeTypeRepository::class)]
class SomeType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: SomeOption::class)]
    private $someOptions;

    public function __construct()
    {
        $this->someOptions = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getType();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, SomeOption>
     */
    public function getSomeOptions(): Collection
    {
        return $this->someOptions;
    }

    public function addSomeOption(SomeOption $someOption): self
    {
        if (!$this->someOptions->contains($someOption)) {
            $this->someOptions[] = $someOption;
            $someOption->setType($this);
        }

        return $this;
    }

    public function removeSomeOption(SomeOption $someOption): self
    {
        if ($this->someOptions->removeElement($someOption)) {
            // set the owning side to null (unless already changed)
            if ($someOption->getType() === $this) {
                $someOption->setType(null);
            }
        }

        return $this;
    }
}
