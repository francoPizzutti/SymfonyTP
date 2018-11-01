<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
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
    private $Nro_Ticket;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Descripcion;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Fecha;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $Hora;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Empleado", inversedBy="Tickets")
     */
    private $Empleado;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Tickets")
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ItemHistoricoEstados", mappedBy="Ticket")
     */
    private $HistorialEstados;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ItemHistoricoClasificacion", mappedBy="Ticket")
     */
    private $HistorialClasificaciones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Intervencion", mappedBy="Ticket")
     */
    private $Intervenciones;

    public function __construct()
    {
        $this->HistorialEstados = new ArrayCollection();
        $this->HistorialClasificaciones = new ArrayCollection();
        $this->Intervenciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNroTicket(): ?int
    {
        return $this->Nro_Ticket;
    }

    public function setNroTicket(int $Nro_Ticket): self
    {
        $this->Nro_Ticket = $Nro_Ticket;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(?\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getHora(): ?\DateTimeInterface
    {
        return $this->Hora;
    }

    public function setHora(?\DateTimeInterface $Hora): self
    {
        $this->Hora = $Hora;

        return $this;
    }

    public function getEmpleado(): ?Empleado
    {
        return $this->Empleado;
    }

    public function setEmpleado(?Empleado $Empleado): self
    {
        $this->Empleado = $Empleado;

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

    /**
     * @return Collection|ItemHistoricoEstados[]
     */
    public function getHistorialEstados(): Collection
    {
        return $this->HistorialEstados;
    }

    public function addHistorialEstado(ItemHistoricoEstados $historialEstado): self
    {
        if (!$this->HistorialEstados->contains($historialEstado)) {
            $this->HistorialEstados[] = $historialEstado;
            $historialEstado->setTicket($this);
        }

        return $this;
    }

    public function removeHistorialEstado(ItemHistoricoEstados $historialEstado): self
    {
        if ($this->HistorialEstados->contains($historialEstado)) {
            $this->HistorialEstados->removeElement($historialEstado);
            // set the owning side to null (unless already changed)
            if ($historialEstado->getTicket() === $this) {
                $historialEstado->setTicket(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ItemHistoricoClasificacion[]
     */
    public function getHistorialClasificaciones(): Collection
    {
        return $this->HistorialClasificaciones;
    }

    public function addHistorialClasificacione(ItemHistoricoClasificacion $historialClasificacione): self
    {
        if (!$this->HistorialClasificaciones->contains($historialClasificacione)) {
            $this->HistorialClasificaciones[] = $historialClasificacione;
            $historialClasificacione->setTicket($this);
        }

        return $this;
    }

    public function removeHistorialClasificacione(ItemHistoricoClasificacion $historialClasificacione): self
    {
        if ($this->HistorialClasificaciones->contains($historialClasificacione)) {
            $this->HistorialClasificaciones->removeElement($historialClasificacione);
            // set the owning side to null (unless already changed)
            if ($historialClasificacione->getTicket() === $this) {
                $historialClasificacione->setTicket(null);
            }
        }

        return $this;
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
            $intervencione->setTicket($this);
        }

        return $this;
    }

    public function removeIntervencione(Intervencion $intervencione): self
    {
        if ($this->Intervenciones->contains($intervencione)) {
            $this->Intervenciones->removeElement($intervencione);
            // set the owning side to null (unless already changed)
            if ($intervencione->getTicket() === $this) {
                $intervencione->setTicket(null);
            }
        }

        return $this;
    }
}
