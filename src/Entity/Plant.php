<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantRepository::class)]
class Plant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?bool $isShow = null;

    #[ORM\OneToOne(inversedBy: 'idPlant', cascade: ['persist', 'remove'])]
    private ?Image $idImage = null;

    #[ORM\OneToMany(mappedBy: 'plant', targetEntity: Find::class)]
    private Collection $idplant;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_after = null;

    public function __construct()
    {
        $this->idplant = new ArrayCollection();
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
    public function __toString() { return $this->name;}
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function isIsShow(): ?bool
    {
        return $this->isShow;
    }

    public function setIsShow(bool $isShow): self
    {
        $this->isShow = $isShow;

        return $this;
    }

    public function getIdImage(): ?Image
    {
        return $this->idImage;
    }

    public function setIdImage(?Image $idImage): self
    {
        $this->idImage = $idImage;

        return $this;
    }

    /**
     * @return Collection<int, Find>
     */
    public function getIdplant(): Collection
    {
        return $this->idplant;
    }

    public function addIdplant(Find $idplant): self
    {
        if (!$this->idplant->contains($idplant)) {
            $this->idplant->add($idplant);
            $idplant->setPlant($this);
        }

        return $this;
    }

    public function removeIdplant(Find $idplant): self
    {
        if ($this->idplant->removeElement($idplant)) {
            // set the owning side to null (unless already changed)
            if ($idplant->getPlant() === $this) {
                $idplant->setPlant(null);
            }
        }

        return $this;
    }

    public function getDescriptionAfter(): ?string
    {
        return $this->description_after;
    }

    public function setDescriptionAfter(string $description_after): self
    {
        $this->description_after = $description_after;

        return $this;
    }
}
