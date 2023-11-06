<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $codecategorie = null;

    #[ORM\Column(length: 255)]
    private ?string $libellecategorie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Saison = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Saison::class)]
    private Collection $saisons;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?appartement $appartement = null;

    public function __construct()
    {
        $this->saisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodecategorie(): ?string
    {
        return $this->codecategorie;
    }

    public function setCodecategorie(string $codecategorie): static
    {
        $this->codecategorie = $codecategorie;

        return $this;
    }

    public function getLibellecategorie(): ?string
    {
        return $this->libellecategorie;
    }

    public function setLibellecategorie(string $libellecategorie): static
    {
        $this->libellecategorie = $libellecategorie;

        return $this;
    }

    public function getSaison(): ?string
    {
        return $this->Saison;
    }

    public function setSaison(?string $Saison): static
    {
        $this->Saison = $Saison;

        return $this;
    }

    /**
     * @return Collection<int, Saison>
     */
    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(Saison $saison): static
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons->add($saison);
            $saison->setCategorie($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): static
    {
        if ($this->saisons->removeElement($saison)) {
            // set the owning side to null (unless already changed)
            if ($saison->getCategorie() === $this) {
                $saison->setCategorie(null);
            }
        }

        return $this;
    }

    public function getAppartement(): ?appartement
    {
        return $this->appartement;
    }

    public function setAppartement(?appartement $appartement): static
    {
        $this->appartement = $appartement;

        return $this;
    }
}
