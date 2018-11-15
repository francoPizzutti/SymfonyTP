<?php
namespace App\Service;

class estadosDTO
{
    private  $id;
    private $Descripcion;

    public function setId($i){
        $this->id = $i;
    }
    public function setDescripcion($i){
        $this->Descripcion = $i;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

}