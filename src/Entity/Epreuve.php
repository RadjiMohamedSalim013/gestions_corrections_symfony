<?php

namespace App\Entity;

use App\Repository\EpreuveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpreuveRepository::class)]
class Epreuve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'epreuves')]
    private ?Examen $examen = null;

    /**
     * @var Collection<int, Correction>
     */
    #[ORM\OneToMany(targetEntity: Correction::class, mappedBy: 'epreuve')]
    private Collection $corrections;

    public function __construct()
    {
        $this->corrections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getExamen(): ?Examen
    {
        return $this->examen;
    }

    public function setExamen(?Examen $examen): static
    {
        $this->examen = $examen;

        return $this;
    }

    /**
     * @return Collection<int, Correction>
     */
    public function getCorrections(): Collection
    {
        return $this->corrections;
    }

    public function addCorrection(Correction $correction): static
    {
        if (!$this->corrections->contains($correction)) {
            $this->corrections->add($correction);
            $correction->setEpreuve($this);
        }

        return $this;
    }

    public function removeCorrection(Correction $correction): static
    {
        if ($this->corrections->removeElement($correction)) {
            // set the owning side to null (unless already changed)
            if ($correction->getEpreuve() === $this) {
                $correction->setEpreuve(null);
            }
        }

        return $this;
    }
}
