<?php
namespace App\Service;

class derivarDTO
{
    private $estado;
    private $id;
    private $descripcion;
    private $grupo;
    private $clasificacion;
    private $nuevoE;

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
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * @param mixed $grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
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
    public function getNuevoE()
    {
        return $this->nuevoE;
    }

    /**
     * @param mixed $nuevoE
     */
    public function setNuevoE($nuevoE)
    {
        $this->nuevoE = $nuevoE;
    }

}