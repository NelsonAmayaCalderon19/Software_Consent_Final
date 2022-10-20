<?php

class Usuario extends conexion{
    private $documento;
    private $clave;

    public function __construct($documento,$clave){
        $this->documento = $documento;
        $this->clave = $clave;
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
 
    public function getClave()
    {
        return $this->clave;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }
}
?>