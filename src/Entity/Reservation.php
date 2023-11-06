<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numreserv = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rueclient = null;

    #[ORM\Column]
    private ?int $cpclient = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $villeclient = null;

    #[ORM\Column(nullable: true)]
    private ?int $telclient = null;

    #[ORM\Column]
    private ?int $numchequeacompte = null;

    #[ORM\Column]
    private ?int $montantacompte = null;

    #[ORM\Column(length: 255)]
    private ?string $etatreserv = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Appartement::class)]
    private Collection $appartements;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?semaine $semaine = null;

    public function __construct()
    {
        $this->appartements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumreserv(): ?int
    {
        return $this->numreserv;
    }

    public function setNumreserv(int $numreserv): static
    {
        $this->numreserv = $numreserv;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
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

    public function getRueclient(): ?string
    {
        return $this->rueclient;
    }

    public function setRueclient(?string $rueclient): static
    {
        $this->rueclient = $rueclient;

        return $this;
    }

    public function getCpclient(): ?int
    {
        return $this->cpclient;
    }

    public function setCpclient(int $cpclient): static
    {
        $this->cpclient = $cpclient;

        return $this;
    }

    public function getVilleclient(): ?string
    {
        return $this->villeclient;
    }

    public function setVilleclient(?string $villeclient): static
    {
        $this->villeclient = $villeclient;

        return $this;
    }

    public function getTelclient(): ?int
    {
        return $this->telclient;
    }

    public function setTelclient(?int $telclient): static
    {
        $this->telclient = $telclient;

        return $this;
    }

    public function getNumchequeacompte(): ?int
    {
        return $this->numchequeacompte;
    }

    public function setNumchequeacompte(int $numchequeacompte): static
    {
        $this->numchequeacompte = $numchequeacompte;

        return $this;
    }

    public function getMontantacompte(): ?int
    {
        return $this->montantacompte;
    }

    public function setMontantacompte(int $montantacompte): static
    {
        $this->montantacompte = $montantacompte;

        return $this;
    }

    public function getEtatreserv(): ?string
    {
        return $this->etatreserv;
    }

    public function setEtatreserv(string $etatreserv): static
    {
        $this->etatreserv = $etatreserv;

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
            $appartement->setReservation($this);
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): static
    {
        if ($this->appartements->removeElement($appartement)) {
            // set the owning side to null (unless already changed)
            if ($appartement->getReservation() === $this) {
                $appartement->setReservation(null);
            }
        }

        return $this;
    }

    public function getSemaine(): ?semaine
    {
        return $this->semaine;
    }

    public function setSemaine(?semaine $semaine): static
    {
        $this->semaine = $semaine;

        return $this;
    }
}
