<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstadoClasificacionTicketRepository")
 */
class EstadoClasificacionTicket
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
    private $Id_Estado_Cla;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Descripcion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEstadoCla(): ?int
    {
        return $this->Id_Estado_Cla;
    }

    public function setIdEstadoCla(int $Id_Estado_Cla): self
    {
        $this->Id_Estado_Cla = $Id_Estado_Cla;

        return $this;
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
}
