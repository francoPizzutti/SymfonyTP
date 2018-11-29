<?php
namespace App\Service;

class ticketDTO
{
    private  $id;
    private $legajo;
    private $fecha_apertura;
    private $fecha_ultimo_cambio;
    private $usuario;
    private $clasificacion;
    private $grupo_resolucion;
    private $estado;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getFechaApertura()
    {
        return $this->fecha_apertura;
    }

    /**
     * @param mixed $fecha_apertura
     */
    public function setFechaApertura($fecha_apertura)
    {
        $this->fecha_apertura = $fecha_apertura;
    }

    /**
     * @return mixed
     */
    public function getFechaUltimoCambio()
    {
        return $this->fecha_ultimo_cambio;
    }

    /**
     * @param mixed $fecha_ultimo_cambio
     */
    public function setFechaUltimoCambio($fecha_ultimo_cambio)
    {
        $this->fecha_ultimo_cambio = $fecha_ultimo_cambio;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    /**
     * @param mixed $clasificacion
     */
    public function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;
    }

    /**
     * @return mixed
     */
    public function getGrupoResolucion()
    {
        return $this->grupo_resolucion;
    }

    /**
     * @param mixed $grupo_resolucion
     */
    public function setGrupoResolucion($grupo_resolucion)
    {
        $this->grupo_resolucion = $grupo_resolucion;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }


}