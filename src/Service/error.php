<?php
// src/Service/MessageGenerator.php
namespace App\Service;

class error
{

    private $errores;

    public function __construct()
    {
        $this->errores =  Array();

    }
    public function set($clave, $valor)
    {
        $this->errores[$clave] = $valor;
    }

    public function get($clave){
        return $this->errores[$clave];
    }

    public function has($clave){
        return array_key_exists ( $clave , $this->errores );
    }
    public function evaluate(){
        if(count($this->errores)>0){
            return true;
        }
        else return false;
    }
}