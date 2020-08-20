<?php

namespace App\Entity;

use App\Repository\ConsommationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsommationRepository::class)
 */
class Consommation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $nombre_litre;

    /**
     * @ORM\Column(type="float")
     */
    private $prixUnitaire;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Compteur::class, inversedBy="consommations")
     */
    private $compteur;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, cascade={"persist", "remove"})
     */
    private $facturation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreLitre(): ?float
    {
        return $this->nombre_litre;
    }

    public function setNombreLitre(float $nombre_litre): self
    {
        $this->nombre_litre = $nombre_litre;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCompteur(): ?Compteur
    {
        return $this->compteur;
    }

    public function setCompteur(?Compteur $compteur): self
    {
        $this->compteur = $compteur;

        return $this;
    }

    public function getFacturation(): ?Facture
    {
        return $this->facturation;
    }

    public function setFacturation(?Facture $facturation): self
    {
        $this->facturation = $facturation;

        return $this;
    }
}
