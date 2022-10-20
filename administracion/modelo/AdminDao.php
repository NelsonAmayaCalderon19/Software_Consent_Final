<?php

class AdminDao extends Usuario{

    public function __construct(){
        $this->conexion = new conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function validar_login($documento, $clave){
     
        $sql="SELECT * FROM usuario as user, profesional as prof WHERE prof.id_estado=1 and  prof.id_cargo=4 and prof.documento=user.documento and user.documento= :documento AND user.clave= (MD5(:clave))";
$resultado=$this->conexion->prepare($sql);
$login=$documento;
$password=$clave;
$resultado->bindValue(":documento", $login);
$resultado->bindValue(":clave", $password);
$resultado->execute();
return $resultado->rowCount();
    }


public function Datos_Usuario($documento){

$sq="SELECT * FROM profesional as prof WHERE prof.documento= :documento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':documento' =>"".$documento.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $dato = $fila["nombre_completo"];
endforeach;
    return $dato;
}
}
?>