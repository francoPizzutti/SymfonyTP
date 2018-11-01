<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrupoResolucionRepository")
 */
class GrupoResolucion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Codigo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Nivel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EstadoGrupoResolucion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Estado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?int
    {
        return $this->Codigo;
    }

    public function setCodigo(int $Codigo): self
    {
        $this->Codigo = $Codigo;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getNivel(): ?int
    {
        return $this->Nivel;
    }

    public function setNivel(?int $Nivel): self
    {
        $this->Nivel = $Nivel;

        return $this;
    }

    public function getEstado(): ?EstadoGrupoResolucion
    {
        return $this->Estado;
    }

    public function setEstado(?EstadoGrupoResolucion $Estado): self
    {
        $this->Estado = $Estado;

        return $this;
    }

    public function __toString() {
        return $this->Nombre;
    }

}
