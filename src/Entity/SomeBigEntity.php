<?php

namespace App\Entity;

use App\Repository\SomeBigEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SomeBigEntityRepository::class)]
class SomeBigEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'someBigEntities')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToMany(targetEntity: SomeM2MEntity::class, inversedBy: 'someBigEntities')]
    private $someM2M;

    #[ORM\ManyToOne(targetEntity: SomeOption::class, inversedBy: 'someBigEntities')]
    private $option;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    public function __construct()
    {
        $this->someM2M = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getDescription();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, SomeM2MEntity>
     */
    public function getSomeM2M(): Collection
    {
        return $this->someM2M;
    }

    public function addSomeM2M(SomeM2MEntity $someM2M): self
    {
        if (!$this->someM2M->contains($someM2M)) {
            $this->someM2M[] = $someM2M;
        }

        return $this;
    }

    public function removeSomeM2M(SomeM2MEntity $someM2M): self
    {
        $this->someM2M->removeElement($someM2M);

        return $this;
    }

    public function getOption(): ?SomeOption
    {
        return $this->option;
    }

    public function setOption(?SomeOption $option): self
    {
        $this->option = $option;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
