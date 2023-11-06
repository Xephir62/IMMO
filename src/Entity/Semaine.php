<?php

namespace App\Entity;

use App\Repository\SemaineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemaineRepository::class)]
class Semaine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column]
    private ?int $numsemaine = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedebut = null;

    #[ORM\OneToMany(mappedBy: 'semaine', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\ManyToMany(targetEntity: saison::class, inversedBy: 'semaines')]
    private Collection $saison;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->saison = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getNumsemaine(): ?int
    {
        return $this->numsemaine;
    }

    public function setNumsemaine(int $numsemaine): static
    {
        $this->numsemaine = $numsemaine;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): static
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setSemaine($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getSemaine() === $this) {
                $reservation->setSemaine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, saison>
     */
    public function getSaison(): Collection
    {
        return $this->saison;
    }

    public function addSaison(saison $saison): static
    {
        if (!$this->saison->contains($saison)) {
            $this->saison->add($saison);
        }

        return $this;
    }

    public function removeSaison(saison $saison): static
    {
        $this->saison->removeElement($saison);

        return $this;
    }
}
