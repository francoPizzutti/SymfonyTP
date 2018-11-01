<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstadoGrupoResolucionRepository")
 */
class EstadoGrupoResolucion
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
    private $Id_Estado_Grupo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Descripcion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEstadoGrupo(): ?int
    {
        return $this->Id_Estado_Grupo;
    }

    public function setIdEstadoGrupo(int $Id_Estado_Grupo): self
    {
        $this->Id_Estado_Grupo = $Id_Estado_Grupo;

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
}
