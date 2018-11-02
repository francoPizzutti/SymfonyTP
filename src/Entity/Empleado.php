<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmpleadoRepository")
 */
class Empleado
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
    private $Legajo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Apellido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Telefono_Interno;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Telefono_Directo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cargo")
     */
    private $Cargo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Direccion", cascade={"persist", "remove"})
     */
    private $Direccion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="Empleado")
     */
    private $Tickets;

    public function __construct()
    {
        $this->Tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLegajo(): ?int
    {
        return $this->Legajo;
    }

    public function setLegajo(int $Legajo): self
    {
        $this->Legajo = $Legajo;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(?string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->Apellido;
    }

    public function setApellido(?string $Apellido): self
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    public function getTelefonoInterno(): ?string
    {
        return $this->Telefono_Interno;
    }

    public function setTelefonoInterno(?string $Telefono_Interno): self
    {
        $this->Telefono_Interno = $Telefono_Interno;

        return $this;
    }

    public function getTelefonoDirecto(): ?string
    {
        return $this->Telefono_Directo;
    }

    public function setTelefonoDirecto(?string $Telefono_Directo): self
    {
        $this->Telefono_Directo = $Telefono_Directo;

        return $this;
    }

    public function getCargo(): ?Cargo
    {
        return $this->Cargo;
    }

    public function setCargo(?Cargo $Cargo): self
    {
        $this->Cargo = $Cargo;

        return $this;
    }

    public function getDireccion(): ?Direccion
    {
        return $this->Direccion;
    }

    public function setDireccion(?Direccion $Direccion): self
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    public function __toString() {
        $nc = $this->Nombre." ".$this->Apellido;
        return $nc;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->Tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->Tickets->contains($ticket)) {
            $this->Tickets[] = $ticket;
            $ticket->setEmpleado($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->Tickets->contains($ticket)) {
            $this->Tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getEmpleado() === $this) {
                $ticket->setEmpleado(null);
            }
        }

        return $this;
    }
}
