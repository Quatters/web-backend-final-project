<?php

namespace App\Entity;

use App\Repository\SomeOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SomeOptionRepository::class)]
class SomeOption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: SomeType::class, inversedBy: 'someOptions')]
    private $type;

    #[ORM\OneToMany(mappedBy: 'option', targetEntity: SomeBigEntity::class)]
    private $someBigEntities;

    public function __construct()
    {
        $this->someBigEntities = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?SomeType
    {
        return $this->type;
    }

    public function setType(?SomeType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, SomeBigEntity>
     */
    public function getSomeBigEntities(): Collection
    {
        return $this->someBigEntities;
    }

    public function addSomeBigEntity(SomeBigEntity $someBigEntity): self
    {
        if (!$this->someBigEntities->contains($someBigEntity)) {
            $this->someBigEntities[] = $someBigEntity;
            $someBigEntity->setOption($this);
        }

        return $this;
    }

    public function removeSomeBigEntity(SomeBigEntity $someBigEntity): self
    {
        if ($this->someBigEntities->removeElement($someBigEntity)) {
            // set the owning side to null (unless already changed)
            if ($someBigEntity->getOption() === $this) {
                $someBigEntity->setOption(null);
            }
        }

        return $this;
    }
}
