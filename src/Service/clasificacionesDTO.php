<?php
namespace App\Service;

class clasificacionesDTO
{
    private  $id;
    private $Nombre;

    public function setId($i){
        $this->id = $i;
    }
    public function setNombre($i){
        $this->Nombre = $i;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

}

