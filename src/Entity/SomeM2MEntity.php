<?php

namespace App\Entity;

use App\Repository\SomeM2MEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SomeM2MEntityRepository::class)]
class SomeM2MEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: SomeBigEntity::class, mappedBy: 'someM2M')]
    private $someBigEntities;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

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
            $someBigEntity->addSomeM2M($this);
        }

        return $this;
    }

    public function removeSomeBigEntity(SomeBigEntity $someBigEntity): self
    {
        if ($this->someBigEntities->removeElement($someBigEntity)) {
            $someBigEntity->removeSomeM2M($this);
        }

        return $this;
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
}
