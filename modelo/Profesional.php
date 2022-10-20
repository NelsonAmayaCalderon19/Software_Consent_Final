<?php

class Profesional{

    private $documento;
    private $nombre;
    private $firma;
    private $cargo;
    private $id_estado;


    public function __construct($documento,$nombre,$firma,$cargo,$id_estado){
        $this->documento = $documento;
        $this->nombre = $nombre;
        $this->firma = $firma;
        $this->cargo = $cargo;
        $this->id_estado = $id_estado;
    }
     
    public function getDocumento()
    {
        return $this->documento;
    }
 
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFirma()
    {
        return $this->firma;
    }

    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    public function getCargo()
    {
        return $this->cargo;
    }
 
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

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