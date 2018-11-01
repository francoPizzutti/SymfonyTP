<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CargoRepository")
 */
class Cargo
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
    private $Id_Cargo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Descripcion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCargo(): ?int
    {
        return $this->Id_Cargo;
    }

    public function setIdCargo(int $Id_Cargo): self
    {
        $this->Id_Cargo = $Id_Cargo;

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
