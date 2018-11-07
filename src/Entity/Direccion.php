<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DireccionRepository")
 */
class Direccion
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
    private $Calle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Piso;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Oficina;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDireccion(): ?int
    {
        return $this->Id_Direccion;
    }

    public function setIdDireccion(int $Id_Direccion): self
    {
        $this->Id_Direccion = $Id_Direccion;

        return $this;
    }

    public function getCalle(): ?string
    {
        return $this->Calle;
    }

    public function setCalle(?string $Calle): self
    {
        $this->Calle = $Calle;

        return $this;
    }

    public function getPiso(): ?int
    {
        return $this->Piso;
    }

    public function setPiso(?int $Piso): self
    {
        $this->Piso = $Piso;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->Numero;
    }

    public function setNumero(?int $Numero): self
    {
        $this->Numero = $Numero;

        return $this;
    }

    public function getOficina(): ?string
    {
        return $this->Oficina;
    }

    public function setOficina(?string $Oficina): self
    {
        $this->Oficina = $Oficina;

        return $this;
    }
}
