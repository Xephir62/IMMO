<?php

namespace App\Entity;

use App\Repository\AppartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartementRepository::class)]
class Appartement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numappart = null;

    #[ORM\Column(nullable: true)]
    private ?int $superficie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptif = null;

    #[ORM\ManyToMany(targetEntity: immeuble::class, inversedBy: 'appartements')]
    private Collection $immeuble;

    #[ORM\ManyToOne(inversedBy: 'appartements')]
    private ?reservation $reservation = null;

    public function __construct()
    {
        $this->immeuble = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumappart(): ?string
    {
        return $this->numappart;
    }

    public function setNumappart(string $numappart): static
    {
        $this->numappart = $numappart;

        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(?int $superficie): static
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): static
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * @return Collection<int, immeuble>
     */
    public function getImmeuble(): Collection
    {
        return $this->immeuble;
    }

    public function addImmeuble(immeuble $immeuble): static
    {
        if (!$this->immeuble->contains($immeuble)) {
            $this->immeuble->add($immeuble);
        }

        return $this;
    }

    public function removeImmeuble(immeuble $immeuble): static
    {
        $this->immeuble->removeElement($immeuble);

        return $this;
    }

    public function getReservation(): ?reservation
    {
        return $this->reservation;
    }

    public function setReservation(?reservation $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }
}
