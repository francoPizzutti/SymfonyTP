<?php
namespace App\Service;

class intervencionDTO
{
private $estadoActual;
private $ticket;
private $descripcion;
private $clasificacion;
private $intervencion;
private $observacion;

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
    public function getEstadoActual()
    {
        return $this->estadoActual;
    }

    /**
     * @param mixed $estadoActual
     */
    public function setEstadoActual($estadoActual)
    {
        $this->estadoActual = $estadoActual;
    }

    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param mixed $ticket
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
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