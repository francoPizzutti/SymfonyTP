<?php
namespace App\Service;

class ticketIntervencionDTO
{
    private $id;
    private $legajo;
    private $intervencion;
    private $fecha_apertura;
    private $clasificacion;
    private $grupo_resolucion;
    private $estado;
    private $estIntervencion;
    private $fechaAsig;
    private $observacion;

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

    /**
     * @return mixed
     */
    public function getEstIntervencion()
    {
        return $this->estIntervencion;
    }

    /**
     * @param mixed $estIntervencion
     */
    public function setEstIntervencion($estIntervencion)
    {
        $this->estIntervencion = $estIntervencion;
    }

    /**
     * @return mixed
     */
    public function getFechaAsig()
    {
        return $this->fechaAsig;
    }

    /**
     * @param mixed $fechaAsig
     */
    public function setFechaAsig($fechaAsig)
    {
        $this->fechaAsig = $fechaAsig;
    }

    /**
     * @return mixed
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * @param mixed $observacion
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    }


    /**
     * @return mixed
     */
    public function getIntervencion()
    {
        return $this->intervencion;
    }

    /**
     * @param mixed $intervencion
     */
    public function setIntervencion($intervencion)
    {
        $this->intervencion = $intervencion;
    }

}