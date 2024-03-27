<?php

namespace App\Entity;

use App\Repository\BordingCardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoardingCardRepository::class)]
class BoardingCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeTransport = null;

    #[ORM\Column(length: 255)]
    private ?string $destination = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $porte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siege = null;

    // Flight number or bus transport number
    #[ORM\Column(length: 255)]
    private ?string $embarcation = null;
    
    #[ORM\Column(length: 255)]
    private ?string $lieuDepart = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeTransport(): ?string
    {
        return $this->typeTransport;
    }

    public function setTypeTransport(string $typeTransport): static
    {
        $this->typeTransport = $typeTransport;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getPorte(): ?string
    {
        return $this->porte;
    }

    public function setPorte(?string $porte): static
    {
        $this->porte = $porte;

        return $this;
    }

    public function getSiege(): ?string
    {
        return $this->siege;
    }

    public function setSiege(?string $siege): static
    {
        $this->siege = $siege;

        return $this;
    }

    public function getEmbarcation(): ?string
    {
        return $this->embarcation;
    }

    public function setEmbarcation(string $embarcation): static
    {
        $this->embarcation = $embarcation;

        return $this;
    }

    public function getLieuDepart(): ?string
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(string $lieuDepart): static
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }
}
