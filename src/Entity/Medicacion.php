<?php

namespace App\Entity;

use App\Repository\MedicacionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicacionRepository::class)
 */
class Medicacion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $compuestoActivo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $comprimidosTotales;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $usosDiarios;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dosis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observaciones;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCompuestoActivo(): ?string
    {
        return $this->compuestoActivo;
    }

    public function setCompuestoActivo(?string $compuestoActivo): self
    {
        $this->compuestoActivo = $compuestoActivo;

        return $this;
    }

    public function getComprimidosTotales(): ?int
    {
        return $this->comprimidosTotales;
    }

    public function setComprimidosTotales(?int $comprimidosTotales): self
    {
        $this->comprimidosTotales = $comprimidosTotales;

        return $this;
    }

    public function getUsosDiarios(): ?int
    {
        return $this->usosDiarios;
    }

    public function setUsosDiarios(?int $usosDiarios): self
    {
        $this->usosDiarios = $usosDiarios;

        return $this;
    }

    public function getDosis(): ?int
    {
        return $this->dosis;
    }

    public function setDosis(?int $dosis): self
    {
        $this->dosis = $dosis;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
