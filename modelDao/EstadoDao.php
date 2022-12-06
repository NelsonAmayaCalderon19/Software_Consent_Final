<?php

class EstadoDao extends Estado{

    public function __construct(){
        $this->conexion = new conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function Consultar_Estado_Por_ID($id){
        $datos = new Estado($id,"");
        $sq="SELECT * FROM estado as est WHERE est.id= :id";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id' =>"".$datos->getId().""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
    $datos->setDescripcion($fila["descripcion"]);
endforeach;
    return $datos->getDescripcion();
    }

    public function Consultar_Estado_Por_Descripcion($descripcion){
        $datos = new Estado("",$descripcion);
        $sq="SELECT * FROM estado as est WHERE est.descripcion= :descripcion";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':descripcion' =>"".$datos->getDescripcion().""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
    $datos->setId($fila["id"]);
endforeach;
    return $datos->getId();
    }
}

?>