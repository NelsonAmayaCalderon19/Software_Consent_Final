<?php

class Examen extends conexion{

    private $codigo;
    private $descripcion;
    private $id_estado;

    public function __construct($codigo,$descripcion,$id_estado){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->id_estado = $id_estado;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getId_estado()
    {
        return $this->id_estado;
    }

    public function setId_estado($id_estado)
    {
        $this->id_estado = $id_estado;

        return $this;
    }
}
?>