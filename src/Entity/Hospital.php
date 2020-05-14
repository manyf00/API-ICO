<?php

namespace App\Entity;

use App\Repository\HospitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Cita::class, mappedBy="hospital")
     */
    private $citas;

    /**
     * @ORM\OneToMany(targetEntity=Usuarios::class, mappedBy="hospital")
     */
    private $usuarios;

    public function __construct()
    {
        $this->citas = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
    }

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

    /**
     * @return Collection|Cita[]
     */
    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addCita(Cita $cita): self
    {
        if (!$this->citas->contains($cita)) {
            $this->citas[] = $cita;
            $cita->setHospital($this);
        }

        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->contains($cita)) {
            $this->citas->removeElement($cita);
            // set the owning side to null (unless already changed)
            if ($cita->getHospital() === $this) {
                $cita->setHospital(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Usuarios[]
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuarios $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            $usuario->setHospital($this);
        }

        return $this;
    }

    public function removeUsuario(Usuarios $usuario): self
    {
        if ($this->usuarios->contains($usuario)) {
            $this->usuarios->removeElement($usuario);
            // set the owning side to null (unless already changed)
            if ($usuario->getHospital() === $this) {
                $usuario->setHospital(null);
            }
        }

        return $this;
    }
}
