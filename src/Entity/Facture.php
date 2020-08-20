<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
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
    private $montant;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $date_facturation;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $date_limite;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $numero;

    /**
     * @ORM\OneToOne(targetEntity=Reglement::class, cascade={"persist", "remove"})
     */
    private $reglement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateFacturation(): ?string
    {
        return $this->date_facturation;
    }

    public function setDateFacturation(string $date_facturation): self
    {
        $this->date_facturation = $date_facturation;

        return $this;
    }

    public function getDateLimite(): ?string
    {
        return $this->date_limite;
    }

    public function setDateLimite(string $date_limite): self
    {
        $this->date_limite = $date_limite;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getReglement(): ?Reglement
    {
        return $this->reglement;
    }

    public function setReglement(?Reglement $reglement): self
    {
        $this->reglement = $reglement;

        return $this;
    }
}
