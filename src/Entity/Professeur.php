<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 30)]
    private ?string $grade = null;

    #[ORM\ManyToOne(inversedBy: 'professeurs')]
    private ?Etablissement $etablissement = null;

    /**
     * @var Collection<int, Correction>
     */
    #[ORM\OneToMany(targetEntity: Correction::class, mappedBy: 'professeur')]
    private Collection $epreuve;

    public function __construct()
    {
        $this->epreuve = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): static
    {
        $this->grade = $grade;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): static
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return Collection<int, Correction>
     */
    public function getEpreuve(): Collection
    {
        return $this->epreuve;
    }

    public function addEpreuve(Correction $epreuve): static
    {
        if (!$this->epreuve->contains($epreuve)) {
            $this->epreuve->add($epreuve);
            $epreuve->setProfesseur($this);
        }

        return $this;
    }

    public function removeEpreuve(Correction $epreuve): static
    {
        if ($this->epreuve->removeElement($epreuve)) {
            // set the owning side to null (unless already changed)
            if ($epreuve->getProfesseur() === $this) {
                $epreuve->setProfesseur(null);
            }
        }

        return $this;
    }
}
