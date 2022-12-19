<?php

class Consentimiento extends conexion{

    private $codigo;
    private $descripcion;
    private $id_estado;
    private $ruta;

    public function __construct($codigo,$descripcion,$ruta,$id_estado){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->ruta = $ruta;
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

    public function getRuta()
    {
        return $this->ruta;
    }

    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }
}
?>