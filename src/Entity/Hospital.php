<?php

namespace App\Entity;

use App\Repository\HospitalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HospitalRepository::class)
 */
class Hospital
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
    private $nombreUnidad;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $telefonos = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $diasAbiertos = [];

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $horaInicio;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $horaFinal;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $correos = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $ubicacion = [];

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

    public function getNombreUnidad(): ?string
    {
        return $this->nombreUnidad;
    }

    public function setNombreUnidad(?string $nombreUnidad): self
    {
        $this->nombreUnidad = $nombreUnidad;

        return $this;
    }

    public function getTelefonos(): ?array
    {
        return $this->telefonos;
    }

    public function setTelefonos(?array $telefonos): self
    {
        $this->telefonos = $telefonos;

        return $this;
    }

    public function getDiasAbiertos(): ?array
    {
        return $this->diasAbiertos;
    }

    public function setDiasAbiertos(?array $diasAbiertos): self
    {
        $this->diasAbiertos = $diasAbiertos;

        return $this;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(?\DateTimeInterface $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraFinal(): ?\DateTimeInterface
    {
        return $this->horaFinal;
    }

    public function setHoraFinal(?\DateTimeInterface $horaFinal): self
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    public function getCorreos(): ?array
    {
        return $this->correos;
    }

    public function setCorreos(?array $correos): self
    {
        $this->correos = $correos;

        return $this;
    }

    public function getUbicacion(): ?array
    {
        return $this->ubicacion;
    }

    public function setUbicacion(?array $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }
}
