<?php

namespace App\Entity;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Id_Item;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdItem(): ?int
    {
        return $this->Id_Item;
    }

    public function setIdItem(?int $Id_Item): self
    {
        $this->Id_Item = $Id_Item;

        return $this;
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
}
