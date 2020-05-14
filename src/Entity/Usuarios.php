<?php

namespace App\Entity;

use App\Repository\UsuariosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuariosRepository::class)
 */
class Usuarios
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
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $correo;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $telefonos = [];

    /**
     * @ORM\ManyToMany(targetEntity=Medicacion::class, mappedBy="usuario")
     */
    private $medicacions;

    /**
     * @ORM\OneToMany(targetEntity=Cita::class, mappedBy="usuario")
     */
    private $citas;

    /**
     * @ORM\OneToMany(targetEntity=Respuesta::class, mappedBy="usuario")
     */
    private $respuestas;

    /**
     * @ORM\OneToMany(targetEntity=Pregunta::class, mappedBy="usuario")
     */
    private $preguntas;

    /**
     * @ORM\ManyToOne(targetEntity=Hospital::class, inversedBy="usuarios")
     */
    private $hospital;

    public function __construct()
    {
        $this->medicacions = new ArrayCollection();
        $this->citas = new ArrayCollection();
        $this->respuestas = new ArrayCollection();
        $this->preguntas = new ArrayCollection();
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): self
    {
        $this->correo = $correo;

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

    /**
     * @return Collection|Medicacion[]
     */
    public function getMedicacions(): Collection
    {
        return $this->medicacions;
    }

    public function addMedicacion(Medicacion $medicacion): self
    {
        if (!$this->medicacions->contains($medicacion)) {
            $this->medicacions[] = $medicacion;
            $medicacion->addUsuario($this);
        }

        return $this;
    }

    public function removeMedicacion(Medicacion $medicacion): self
    {
        if ($this->medicacions->contains($medicacion)) {
            $this->medicacions->removeElement($medicacion);
            $medicacion->removeUsuario($this);
        }

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
            $cita->setUsuario($this);
        }

        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->contains($cita)) {
            $this->citas->removeElement($cita);
            // set the owning side to null (unless already changed)
            if ($cita->getUsuario() === $this) {
                $cita->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Respuesta[]
     */
    public function getRespuestas(): Collection
    {
        return $this->respuestas;
    }

    public function addRespuesta(Respuesta $respuesta): self
    {
        if (!$this->respuestas->contains($respuesta)) {
            $this->respuestas[] = $respuesta;
            $respuesta->setUsuario($this);
        }

        return $this;
    }

    public function removeRespuesta(Respuesta $respuesta): self
    {
        if ($this->respuestas->contains($respuesta)) {
            $this->respuestas->removeElement($respuesta);
            // set the owning side to null (unless already changed)
            if ($respuesta->getUsuario() === $this) {
                $respuesta->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pregunta[]
     */
    public function getPreguntas(): Collection
    {
        return $this->preguntas;
    }

    public function addPregunta(Pregunta $pregunta): self
    {
        if (!$this->preguntas->contains($pregunta)) {
            $this->preguntas[] = $pregunta;
            $pregunta->setUsuario($this);
        }

        return $this;
    }

    public function removePregunta(Pregunta $pregunta): self
    {
        if ($this->preguntas->contains($pregunta)) {
            $this->preguntas->removeElement($pregunta);
            // set the owning side to null (unless already changed)
            if ($pregunta->getUsuario() === $this) {
                $pregunta->setUsuario(null);
            }
        }

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
}
