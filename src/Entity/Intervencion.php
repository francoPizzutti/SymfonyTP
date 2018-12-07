<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IntervencionRepository")
 */
class Intervencion
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
    private $Observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GrupoResolucion", inversedBy="Intervenciones")
     */
    private $Grupo_Resolucion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket", inversedBy="intervencions")
     */
    private $Ticket;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ItemHistoricoIntervencion", mappedBy="intervencion", cascade={"persist"})
     */
    private $HistorialIntervencion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha_Desde;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha_Hasta;


    public function __construct()
    {
        $this->HistorialIntervencion = new ArrayCollection();
        $this->Fecha_Desde = new DateTime();
    }



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getObservaciones(): ?string
    {
        return $this->Observaciones;
    }

    public function setObservaciones(?string $Observaciones): self
    {
        $this->Observaciones = $Observaciones;

        return $this;
    }

    public function getGrupoResolucion(): ?GrupoResolucion
    {
        return $this->Grupo_Resolucion;
    }

    public function setGrupoResolucion(?GrupoResolucion $Grupo_Resolucion): self
    {
        $this->Grupo_Resolucion = $Grupo_Resolucion;

        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->Ticket;
    }

    public function setTicket(?Ticket $Ticket): self
    {
        $this->Ticket = $Ticket;

        return $this;
    }

    /**
     * @return Collection|ItemHistoricoIntervencion[]
     */
    public function getHistorialIntervencion(): Collection
    {
        return $this->HistorialIntervencion;
    }

    public function addHistorialIntervencion(ItemHistoricoIntervencion $historialIntervencion): self
    {
        if (!$this->HistorialIntervencion->contains($historialIntervencion)) {
            $this->HistorialIntervencion[] = $historialIntervencion;
            $historialIntervencion->setIntervencion($this);
        }

        return $this;
    }

    public function removeHistorialIntervencion(ItemHistoricoIntervencion $historialIntervencion): self
    {
        if ($this->HistorialIntervencion->contains($historialIntervencion)) {
            $this->HistorialIntervencion->removeElement($historialIntervencion);
            // set the owning side to null (unless already changed)
            if ($historialIntervencion->getIntervencion() === $this) {
                $historialIntervencion->setIntervencion(null);
            }
        }

        return $this;
    }

    public function getFechaDesde(): ?\DateTimeInterface
    {
        return $this->Fecha_Desde;
    }

    public function getFechaDesdeString()
    {
        return $this->Fecha_Desde->format('Y-m-d');
    }

    public function setFechaDesde(?\DateTimeInterface $Fecha_Desde): self
    {
        $this->Fecha_Desde = $Fecha_Desde;

        return $this;
    }

    public function getFechaHasta(): ?\DateTimeInterface
    {
        return $this->Fecha_Hasta;
    }

    public function setFechaHasta(?\DateTimeInterface $Fecha_Hasta): self
    {
        $this->Fecha_Hasta = $Fecha_Hasta;

        return $this;
    }

    public function cerrar(){
        $this->HistorialIntervencion->last()->cerrar();
        $this->Fecha_Hasta = new DateTime();
    }


}
