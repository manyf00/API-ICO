<?php

namespace App\Entity;

use App\Repository\CitaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CitaRepository::class)
 */
class Cita
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $edificio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $box;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $indicaciones;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Hospital::class, inversedBy="citas")
     */
    private $hospital;

    /**
     * @ORM\ManyToOne(targetEntity=Usuarios::class, inversedBy="citas")
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $hora;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getEdificio(): ?string
    {
        return $this->edificio;
    }

    public function setEdificio(?string $edificio): self
    {
        $this->edificio = $edificio;

        return $this;
    }

    public function getBox(): ?string
    {
        return $this->box;
    }

    public function setBox(?string $box): self
    {
        $this->box = $box;

        return $this;
    }

    public function getIndicaciones(): ?string
    {
        return $this->indicaciones;
    }

    public function setIndicaciones(?string $indicaciones): self
    {
        $this->indicaciones = $indicaciones;

        return $this;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(?bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): self
    {
        $this->hospital = $hospital;

        return $this;
    }

    public function getUsuario(): ?Usuarios
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuarios $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(?string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }
}
