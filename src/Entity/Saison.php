<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numsaison = null;

    #[ORM\Column(length: 255)]
    private ?string $libellesaison = null;

    #[ORM\ManyToMany(targetEntity: Semaine::class, mappedBy: 'saison')]
    private Collection $semaines;

    #[ORM\ManyToOne(inversedBy: 'saisons')]
    private ?categorie $categorie = null;

    public function __construct()
    {
        $this->semaines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumsaison(): ?string
    {
        return $this->numsaison;
    }

    public function setNumsaison(string $numsaison): static
    {
        $this->numsaison = $numsaison;

        return $this;
    }

    public function getLibellesaison(): ?string
    {
        return $this->libellesaison;
    }

    public function setLibellesaison(string $libellesaison): static
    {
        $this->libellesaison = $libellesaison;

        return $this;
    }

    /**
     * @return Collection<int, Semaine>
     */
    public function getSemaines(): Collection
    {
        return $this->semaines;
    }

    public function addSemaine(Semaine $semaine): static
    {
        if (!$this->semaines->contains($semaine)) {
            $this->semaines->add($semaine);
            $semaine->addSaison($this);
        }

        return $this;
    }

    public function removeSemaine(Semaine $semaine): static
    {
        if ($this->semaines->removeElement($semaine)) {
            $semaine->removeSaison($this);
        }

        return $this;
    }

    public function getCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
