<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasificacionTicketRepository")
 */
class ClasificacionTicket
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
    private $Descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EstadoClasificacionTicket")
     */
    private $Estado_Cla;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(?string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

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

    public function getEstadoCla(): ?EstadoClasificacionTicket
    {
        return $this->Estado_Cla;
    }

    public function setEstadoCla(?EstadoClasificacionTicket $Estado_Cla): self
    {
        $this->Estado_Cla = $Estado_Cla;

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
