<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Intervencion", mappedBy="Grupo_Resolucion")
     */
    private $Intervenciones;

    public function __construct()
    {
        $this->Intervenciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Intervencion[]
     */
    public function getIntervenciones(): Collection
    {
        return $this->Intervenciones;
    }

    public function addIntervencione(Intervencion $intervencione): self
    {
        if (!$this->Intervenciones->contains($intervencione)) {
            $this->Intervenciones[] = $intervencione;
            $intervencione->setGrupoResolucion($this);
        }

        return $this;
    }

    public function removeIntervencione(Intervencion $intervencione): self
    {
        if ($this->Intervenciones->contains($intervencione)) {
            $this->Intervenciones->removeElement($intervencione);
            // set the owning side to null (unless already changed)
            if ($intervencione->getGrupoResolucion() === $this) {
                $intervencione->setGrupoResolucion(null);
            }
        }

        return $this;
    }

}
