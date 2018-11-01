<?php

namespace App\Entity;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Codigo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GrupoResolucion", inversedBy="Intervenciones")
     */
    private $Grupo_Resolucion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticket", inversedBy="Intervenciones")
     */
    private $Ticket;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?int
    {
        return $this->Codigo;
    }

    public function setCodigo(?int $Codigo): self
    {
        $this->Codigo = $Codigo;

        return $this;
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
}
