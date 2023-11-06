<?php

namespace App\Entity;

use App\Repository\ImmeubleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImmeubleRepository::class)]
class Immeuble
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Numimmeuble = null;

    #[ORM\Column(length: 255)]
    private ?string $nomimmeuble = null;

    #[ORM\Column(length: 255)]
    private ?string $rueimmeuble = null;

    #[ORM\Column(length: 255)]
    private ?string $cpimmeuble = null;

    #[ORM\Column(length: 255)]
    private ?string $villeimmeuble = null;

    #[ORM\ManyToMany(targetEntity: Appartement::class, mappedBy: 'immeuble')]
    private Collection $appartements;

    public function __construct()
    {
        $this->appartements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumimmeuble(): ?string
    {
        return $this->Numimmeuble;
    }

    public function setNumimmeuble(string $Numimmeuble): static
    {
        $this->Numimmeuble = $Numimmeuble;

        return $this;
    }

    public function getNomimmeuble(): ?string
    {
        return $this->nomimmeuble;
    }

    public function setNomimmeuble(string $nomimmeuble): static
    {
        $this->nomimmeuble = $nomimmeuble;

        return $this;
    }

    public function getRueimmeuble(): ?string
    {
        return $this->rueimmeuble;
    }

    public function setRueimmeuble(string $rueimmeuble): static
    {
        $this->rueimmeuble = $rueimmeuble;

        return $this;
    }

    public function getCpimmeuble(): ?string
    {
        return $this->cpimmeuble;
    }

    public function setCpimmeuble(string $cpimmeuble): static
    {
        $this->cpimmeuble = $cpimmeuble;

        return $this;
    }

    public function getVilleimmeuble(): ?string
    {
        return $this->villeimmeuble;
    }

    public function setVilleimmeuble(string $villeimmeuble): static
    {
        $this->villeimmeuble = $villeimmeuble;

        return $this;
    }

    /**
     * @return Collection<int, Appartement>
     */
    public function getAppartements(): Collection
    {
        return $this->appartements;
    }

    public function addAppartement(Appartement $appartement): static
    {
        if (!$this->appartements->contains($appartement)) {
            $this->appartements->add($appartement);
            $appartement->addImmeuble($this);
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): static
    {
        if ($this->appartements->removeElement($appartement)) {
            $appartement->removeImmeuble($this);
        }

        return $this;
    }
}
