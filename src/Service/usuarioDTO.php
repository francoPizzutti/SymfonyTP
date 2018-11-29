<?php
namespace App\Service;

class usuarioDTO
{
    private $nombre;
    private $apellido;
    private $legajo;
    private $cargo;
    private $telInterno;
    private $telDirecto;
    private $calle;
    private $numero;
    private $piso;
    private $oficina;

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * @param mixed $legajo
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;
    }

    /**
     * @return mixed
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param mixed $cargo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * @return mixed
     */
    public function getTelInterno()
    {
        return $this->telInterno;
    }

    /**
     * @param mixed $telInterno
     */
    public function setTelInterno($telInterno)
    {
        $this->telInterno = $telInterno;
    }

    /**
     * @return mixed
     */
    public function getTelDirecto()
    {
        return $this->telDirecto;
    }

    /**
     * @param mixed $telDirecto
     */
    public function setTelDirecto($telDirecto)
    {
        $this->telDirecto = $telDirecto;
    }

    /**
     * @return mixed
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param mixed $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * @param mixed $piso
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
    }

    /**
     * @return mixed
     */
    public function getOficina()
    {
        return $this->oficina;
    }

    /**
     * @param mixed $oficina
     */
    public function setOficina($oficina)
    {
        $this->oficina = $oficina;
    }

}