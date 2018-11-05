<?php
// src/Service/MessageGenerator.php
namespace App\Service;

class requestflash
{

    private $valor;
    private $contador;

    public function __construct()
    {
        $this->valor =  Array();
        $this->contador=0;

    }
    public function set($item)
    {
       array_push($this->valor, $item);
       $this->contador++;
    }

    public function get($index){
        return $this->valor[$index];
    }


}