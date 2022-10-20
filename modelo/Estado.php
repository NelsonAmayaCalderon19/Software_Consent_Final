<?php
//include_once "../Conexion/Conexion.php";

class Estado extends conexion{

    private $id;
    private $descripcion;

    public function __construct($id,$descripcion){
        $this->id = $id;
        $this->descripcion = $descripcion;
    }
    

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

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
}
?>