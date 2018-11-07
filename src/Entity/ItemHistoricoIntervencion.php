<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemHistoricoIntervencionRepository")
 */
class ItemHistoricoIntervencion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha_Desde;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha_Hasta;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $Hora_Desde;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $Hora_Hasta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EstadoIntervencion")
     */
    private $Estado_Intervencion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Intervencion", inversedBy="HistorialIntervencion")
     */
    private $intervencion;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getFechaDesde(): ?\DateTimeInterface
    {
        return $this->Fecha_Desde;
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

    public function getHoraDesde(): ?\DateTimeInterface
    {
        return $this->Hora_Desde;
    }

    public function setHoraDesde(?\DateTimeInterface $Hora_Desde): self
    {
        $this->Hora_Desde = $Hora_Desde;

        return $this;
    }

    public function getHoraHasta(): ?\DateTimeInterface
    {
        return $this->Hora_Hasta;
    }

    public function setHoraHasta(?\DateTimeInterface $Hora_Hasta): self
    {
        $this->Hora_Hasta = $Hora_Hasta;

        return $this;
    }

    public function getEstadoIntervencion(): ?EstadoIntervencion
    {
        return $this->Estado_Intervencion;
    }

    public function setEstadoIntervencion(?EstadoIntervencion $Estado_Intervencion): self
    {
        $this->Estado_Intervencion = $Estado_Intervencion;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
    public function __construct()
    {
        $this->Fecha_Desde=new DateTime();
        $this->Hora_Desde=null;
    }

    public function getIntervencion(): ?Intervencion
    {
        return $this->intervencion;
    }

    public function setIntervencion(?Intervencion $intervencion): self
    {
        $this->intervencion = $intervencion;

        return $this;
    }
}
