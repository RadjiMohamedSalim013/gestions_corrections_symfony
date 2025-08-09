<?php

namespace App\Entity;

use App\Repository\CorrectionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CorrectionRepository::class)]
#[ORM\Table(name: 'correction', uniqueConstraints: [
    new ORM\UniqueConstraint(name: 'unique_couple', columns: ['professeur_id', 'epreuve_id'])
])]
class Correction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column]
    private ?int $nbrCopie = null;

    #[ORM\ManyToOne(inversedBy: 'epreuve')]
    private ?Professeur $professeur = null;

    #[ORM\ManyToOne(inversedBy: 'corrections')]
    private ?Epreuve $epreuve = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getNbrCopie(): ?int
    {
        return $this->nbrCopie;
    }

    public function setNbrCopie(int $nbrCopie): static
    {
        $this->nbrCopie = $nbrCopie;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): static
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getEpreuve(): ?Epreuve
    {
        return $this->epreuve;
    }

    public function setEpreuve(?Epreuve $epreuve): static
    {
        $this->epreuve = $epreuve;

        return $this;
    }
}
