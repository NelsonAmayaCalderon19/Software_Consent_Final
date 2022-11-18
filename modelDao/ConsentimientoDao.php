<?php

class ConsentimientoDao extends Consentimiento{

    public function __construct(){
        $this->conexion = new conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function Consultar_Nombre_Consentimiento($codigo){
        $sq="SELECT * FROM consentimiento as cons WHERE cons.codigo= :codigo";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':codigo' =>"".$codigo.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $nombre = $fila["descripcion"];
endforeach;
    return $nombre;
    }

    public function Consultar_Datos_Representante($id_cita){
        $sq="SELECT * FROM cita_consent as cons WHERE cons.id_cita= :id_cita";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_cita' =>"".$id_cita.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["nombre_representante"];
        $cont++;
        $dir[$cont] = $fila["parentesco_representante"];
        $cont++;
        $dir[$cont] = $fila["documento_representante"];
        $cont++;
endforeach;
return $dir;
    }

    public function Eliminar_Examen_Consentimiento($cod_examen,$cod_consentimiento){
        $sq="DELETE FROM consent_examen WHERE cod_examen= :cod_examen and cod_consentimiento= :cod_consentimiento";
        $result=$this->conexion->prepare($sq);
        $result->execute(array(
            ':cod_examen' =>"".$cod_examen."",
            ':cod_consentimiento' =>"".$cod_consentimiento.""
          ));
        $results = $result -> fetchAll();
    }
    public function Eliminar_Consent_Examen($cod_consentimiento){
        $sq="DELETE FROM consent_examen WHERE cod_consentimiento= :cod_consentimiento";
        $result=$this->conexion->prepare($sq);
        $result->execute(array(
            ':cod_consentimiento' =>"".$cod_consentimiento.""
          ));
        $results = $result -> fetchAll();
    }

    public function Consultar_Archivo_Consentimiento($codigo){
        $sq="SELECT * FROM consentimiento as cons WHERE cons.codigo= :codigo";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':codigo' =>"".$codigo.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $nombre = $fila["ruta_archivo"];
endforeach;
    return $nombre;
    }

    public function Consultar_Estado_Consentimiento($codigo){
        $sq="SELECT * FROM consentimiento as cons WHERE cons.codigo= :codigo";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':codigo' =>"".$codigo.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $estado = $fila["id_estado"];
endforeach;
    return $estado;
    }

    public function Consultar_Formulario_Consentimiento($codigo){
        $sq="SELECT * FROM consentimiento as cons WHERE cons.codigo= :codigo";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':codigo' =>"".$codigo.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $nombre = $fila["formulario"];
endforeach;
    return $nombre;
    }


    public function Consultar_Firmante_Consentimiento($codigo){
        $sq="SELECT * FROM consentimiento_detalle WHERE cod_consentimiento= :codigo";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':codigo' =>"".$codigo.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $nombre = $fila["profesional_firma"];
endforeach;
    return $nombre;
    }

    public function Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,$id_estado,$archivo_adjunto){
        $sq ="UPDATE cita_consent SET id_estado=:id_estado, archivo_adjunto=:archivo_adjunto WHERE id_cita= :id_cita and cod_consentimiento= :cod_consentimiento";
        $result=$this->conexion->prepare($sq);
        $result->execute(array(
            ':id_estado' =>"".$id_estado."",
            ':archivo_adjunto' =>"".$archivo_adjunto."",
            ':id_cita' =>"".$id_cita."",
            ':cod_consentimiento' =>"".$id_consentimiento.""
          ));
          return $result->rowCount();
    }

    public function Actualizar_Estado_Consentimiento_Venopuncion($id_cita,$id_consentimiento,$id_estado){
        $sq ="UPDATE cita_consent SET id_estado=:id_estado WHERE id_cita= :id_cita and cod_consentimiento= :cod_consentimiento";
        $result=$this->conexion->prepare($sq);
        $result->execute(array(
            ':id_estado' =>"".$id_estado."",
            ':id_cita' =>"".$id_cita."",
            ':cod_consentimiento' =>"".$id_consentimiento.""
          ));
          return $result->rowCount();
    }

    public function Actualizar_Firma_Consentimiento($id_cita,$firma_temp){
        $sq ="UPDATE cita_consent SET  firma_temp=:firma_temp WHERE id_cita= :id_cita";
        $result=$this->conexion->prepare($sq);
        $result->execute(array(
            ':firma_temp' =>"".$firma_temp."",
            ':id_cita' =>"".$id_cita.""
          ));
          return $result->rowCount();
    }


public function Consultar_Consentimiento_Paciente($id_cita,$id_consentimiento){
    $sq="SELECT * FROM cita_consent WHERE id_cita= :id_cita and cod_consentimiento= :cod_consentimiento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_cita' =>"".$id_cita."",
    ':cod_consentimiento' =>"".$id_consentimiento.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["id_cita"];
        $cont++;
        $dir[$cont] = $fila["cod_consentimiento"];
        $cont++;
        $dir[$cont] = $fila["archivo_adjunto"];
        $cont++;
endforeach;
return $dir;
}

public function Consultar_Firma_Cita($id_cita){
    $sq="SELECT * FROM cita_consent WHERE id_cita= :id_cita ";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_cita' =>"".$id_cita.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["firma_temp"];
        $cont++;
endforeach;
return $dir;
}

public function Consultar_Firma_Consentimiento_Paciente($id_cita,$id_consentimiento){
    $sq="SELECT * FROM cita_consent WHERE id_cita= :id_cita and cod_consentimiento= :cod_consentimiento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_cita' =>"".$id_cita."",
    ':cod_consentimiento' =>"".$id_consentimiento.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["id_cita"];
        $cont++;
        $dir[$cont] = $fila["cod_consentimiento"];
        $cont++;
        $dir[$cont] = $fila["firma_temp"];
        $cont++;
endforeach;
return $dir;
}

public function Consultar_Consentimiento_Detalles($id_consentimiento){
    $sq="SELECT * FROM consentimiento_detalle WHERE cod_consentimiento= :id_consentimiento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_consentimiento' =>"".$id_consentimiento.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["cod_consentimiento"];
        $cont++;
        $dir[$cont] = $fila["nombre"];
        $cont++;
        $dir[$cont] = $fila["descripcion"];
        $cont++;
        $dir[$cont] = $fila["objetivo"];
        $cont++;
        $dir[$cont] = $fila["beneficio"];
        $cont++;
        $dir[$cont] = $fila["riesgo"];
        $cont++;
        $dir[$cont] = $fila["existe_alternativa"];
        $cont++;
        $dir[$cont] = $fila["alternativa"];
        $cont++;
        $dir[$cont] = $fila["decision"];
        $cont++;
        $dir[$cont] = $fila["revocatoria"];
        $cont++;
        $dir[$cont] = $fila["profesional_firma"];
        $cont++;
endforeach;
return $dir;
}

public function Validar_Consentimientos_Cita_Firmados($id_cita){
    $sq="SELECT COUNT(id_cita) AS cantidad FROM cita_consent WHERE id_Estado NOT BETWEEN 7 AND 9 AND id_cita= :id_cita";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_cita' =>"".$id_cita.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $cantidad = $fila["cantidad"];
endforeach;
    return $cantidad;
}
public function Validar_Consentimientos_Cita_Firmados_Sin_Firma_Pendiente($id_cita){
    $sq="SELECT COUNT(id_cita) AS cantidad FROM cita_consent WHERE id_Estado=10 AND id_cita= :id_cita";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_cita' =>"".$id_cita.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $cantidad = $fila["cantidad"];
endforeach;
    return $cantidad;
}
public function Validar_Consentimientos_Cita_Pendientes($id_cita){
    $sq="SELECT COUNT(id_cita) AS cantidad FROM cita_consent WHERE id_Estado=6 AND id_cita= :id_cita";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_cita' =>"".$id_cita.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $cantidad = $fila["cantidad"];
endforeach;
    return $cantidad;
}

public function Buscar_Relacion($cod_examen,$cod_consentimiento){
    $cantidad="";
    $sq="SELECT cod_examen FROM consent_examen WHERE cod_examen=:cod_examen AND cod_consentimiento= :cod_consentimiento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':cod_examen' =>"".$cod_examen."",
    ':cod_consentimiento' =>"".$cod_consentimiento.""
  ));
$results = $result -> fetchAll();

foreach($results as $fila):
        $cantidad = $fila["cod_examen"];
endforeach;
    return $cantidad;
}

public function Actualizar_Estado_Cita($id_cita){
    $sq ="UPDATE cita SET id_estado=4 WHERE id_cita= :id_cita";
        $result=$this->conexion->prepare($sq);
        $result->execute(array(   
            ':id_cita' =>"".$id_cita.""
            
          ));
          return $result->rowCount();
}

public function Retornar_Estado_Inicial_Cita($id_cita){
    $sq ="UPDATE cita SET id_estado=3 WHERE id_cita= :id_cita";
        $result=$this->conexion->prepare($sq);
        $result->execute(array(   
            ':id_cita' =>"".$id_cita.""
            
          ));
          return $result->rowCount();
}

public function Guardar_Consentimiento($codigo,$descripcion,$ruta_archivo){
    $datos = new Consentimiento($codigo,$descripcion,$ruta_archivo,1);
    $consulta = "INSERT INTO consentimiento(codigo,descripcion,ruta_archivo,id_estado) 
    VALUES(:codigo,:descripcion,:ruta_archivo,:id_estado)";
    
$sql = $this->conexion->prepare($consulta);

$sql->bindValue(':codigo',$datos->getCodigo());
$sql->bindValue(':descripcion',$datos->getDescripcion());
$sql->bindValue(':ruta_archivo',$datos->getRuta());
$sql->bindValue(':id_estado',$datos->getId_estado());
$sql->execute();
return $sql;
}
public function Guardar_Consentimiento_Examen($cod_examen,$cod_consentimiento){
    $consulta = "INSERT INTO consent_examen(cod_examen,cod_consentimiento) 
    VALUES(:cod_examen,:cod_consentimiento)";
    
$sq = $this->conexion->prepare($consulta);

//$sub_fech = Cita::Validar_Fecha($fecha);

$sq->bindValue(':cod_examen',$cod_examen);
$sq->bindValue(':cod_consentimiento',$cod_consentimiento);     
$sq->execute();
return $sq;
}

public function Guardar_Datos_Representante($id_cita,$nombre_representante,$parentesco_representante,$documento_representante){
    $sq ="UPDATE cita_consent SET nombre_representante=:nombre_representante, parentesco_representante=:parentesco_representante, documento_representante=:documento_representante WHERE id_cita= :id_cita";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':nombre_representante' =>"".$nombre_representante."",
        ':parentesco_representante' =>"".$parentesco_representante."",
        ':documento_representante' =>"".$documento_representante."",
        ':id_cita' =>"".$id_cita.""
        
      ));
      return $result->rowCount();
}

public function Resetear_Datos_Representante($id_cita){
    $sq ="UPDATE cita_consent SET nombre_representante=NULL,parentesco_representante=NULL,documento_representante=NULL WHERE id_cita= :id_cita";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':id_cita' =>"".$id_cita.""
        
      ));
      return $result->rowCount();
}

public function Guardar_Consentimiento_Detalle($cod_consentimiento,$nombre,$descripcion,$objetivo,$beneficio,$riesgo,$existe_alternativa,$alternativa,$decision,$revocatoria,$profesional_firma){
    $consulta = "INSERT INTO consentimiento_detalle(cod_consentimiento,nombre,descripcion,objetivo,beneficio,riesgo,existe_alternativa,alternativa,decision,revocatoria,profesional_firma) 
    VALUES(:cod_consentimiento,:nombre,:descripcion,:objetivo,:beneficio,:riesgo,:existe_alternativa,:alternativa,:decision,:revocatoria,:profesional_firma)";
    
$sq = $this->conexion->prepare($consulta);

$sq->bindValue(':cod_consentimiento',$cod_consentimiento);
$sq->bindValue(':nombre',$nombre);   
$sq->bindValue(':descripcion',$descripcion);
$sq->bindValue(':objetivo',$objetivo);
$sq->bindValue(':beneficio',$beneficio);
$sq->bindValue(':riesgo',$riesgo);
$sq->bindValue(':existe_alternativa',$existe_alternativa);
$sq->bindValue(':alternativa',$alternativa);
$sq->bindValue(':decision',$decision);  
$sq->bindValue(':revocatoria',$revocatoria);
$sq->bindValue(':profesional_firma',$profesional_firma);
$sq->execute();
return $sq;
}

public function Actualizar_Consentimiento_Detalle($cod_consentimiento,$nombre,$descripcion,$objetivo,$beneficio,$riesgo,$existe_alternativa,$alternativa,$decision,$revocatoria,$profesional_firma){
    $sq ="UPDATE consentimiento_detalle SET descripcion=:descripcion, objetivo=:objetivo, beneficio=:beneficio, riesgo=:riesgo, existe_alternativa=:existe_alternativa, alternativa=:alternativa, decision=:decision, revocatoria=:revocatoria, profesional_firma=:profesional_firma WHERE cod_consentimiento= :cod_consentimiento";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':descripcion' =>"".$descripcion."",
        ':objetivo' =>"".$objetivo."",
        ':beneficio' =>"".$beneficio."",
        ':riesgo' =>"".$riesgo."",
        ':existe_alternativa' =>"".$existe_alternativa."",
        ':alternativa' =>"".$alternativa."",
        ':decision' =>"".$decision."",
        ':revocatoria' =>"".$revocatoria."",
        ':profesional_firma' =>"".$profesional_firma."",
        ':cod_consentimiento' =>"".$cod_consentimiento.""
      ));
      return $result->rowCount();
}
public function Obtener_Id_Cita(){
    $sq="SELECT MAX(id_cita) ultimo FROM cita";
$result=$this->conexion->prepare($sq);
$results = $result -> fetchAll();
foreach($results as $fila):
    $cod = $fila["ultimo"];
endforeach;
return $cod;
}

public function Consultar_Consentimiento_Formato($id_consentimiento){
    $sq="SELECT * FROM consentimiento WHERE codigo= :cod_consentimiento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':cod_consentimiento' =>"".$id_consentimiento.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["codigo"];
        $cont++;
        $dir[$cont] = $fila["ruta_archivo"];
        $cont++;
endforeach;
return $dir;
}

public function InActivar_Consentimiento($codigo,$id_estado){
    $sq ="UPDATE consentimiento SET id_estado=:id_estado WHERE codigo= :codigo";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':id_estado' =>"".$id_estado."",
        ':codigo' =>"".$codigo.""
      ));
      return $result->rowCount();
}
}
?>