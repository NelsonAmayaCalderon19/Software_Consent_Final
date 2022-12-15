<?php
class CitaDao extends Cita{
    private $result_mes = "";
    private $posicion = 0;
    private $sub_fech = "";

public function __construct(){
        $this->conexion = new conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function Consultar_Cod_Examen($nombre){
        $datos = new Examen("",$nombre,"");
        $sq="SELECT * FROM examen as exam WHERE exam.descripcion= :descripcion";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':descripcion' =>"".$datos->getDescripcion().""
  ));
$results = $result -> fetchAll();
foreach($results as $fila):
        $datos->setCodigo($fila["codigo"]);
endforeach;
    return $datos->getCodigo();
    }

    public function Consultar_Cod_Profesional_Registrado($documento){
        $cod = "";
        $sq="SELECT * FROM profesional as prof WHERE prof.documento= :documento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':documento' =>"".$documento.""
  ));
$results = $result -> fetchAll();
foreach($results as $fila):
        $cod = $fila["documento"];
endforeach;
    return $cod;
    }

public function Validar_Fecha($fecha){
    $sub_fecha = $fecha;
    $partes = explode("/", $sub_fecha);
    $dia = $partes[0];
    $mes = $partes[1];  
    $anio = $partes[2];  
    $meses = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
           'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    if(in_array($mes, $meses))
    {
        $posicion = array_search($mes, $meses);
        $result_mes =$posicion+1;
    } else {
        $result_mes = 0;
    }  
    $sub_fech = $anio . '-' . $result_mes . '-' . $dia;
    return $sub_fech;
}
public function Guardar_Cita($nombre_p,$apellido_p,$documento,$tipo_documento,$edad,$afiliacion,$aseguradora,$regimen,$sexo,$fecha,$hora,$ced_medico,$consultorio,$tipo_examen,$cod_examen,$sede,$id_estado,$esquema_clinico){
    $datos = new Cita($nombre_p,$apellido_p,$documento,$tipo_documento,$edad,$afiliacion,$aseguradora,$regimen,$sexo,$fecha,$hora,$ced_medico,$consultorio,$tipo_examen,$cod_examen,$sede,$id_estado,$esquema_clinico);
    $consulta = "INSERT INTO cita(nombre_paciente,apellido_paciente,documento,tipo_documento,edad,plan_afiliacion,aseguradora,regimen,sexo,fecha,hora,ced_medico,consultorio,tipo_examen,cod_examen,sede,id_estado,esquema_clinico) 
VALUES(:nombre_p,:apellido_p,:documento,:tipo_documento,:edad,:afiliacion,:aseguradora,:regimen,:sexo,:fecha,:hora,:ced_medico,:consultorio,:tipo_examen,:cod_examen,:sede,:id_estado,:esquema_clinico)";
$sql = $this->conexion->prepare($consulta);
$sub_fech = CitaDao::Validar_Fecha($datos->getFecha());
$sql->bindValue(':nombre_p',$datos->getNombre_paciente());
$sql->bindValue(':apellido_p',$datos->getApellido_paciente());
$sql->bindValue(':documento',$datos->getDocumento());
$sql->bindValue(':tipo_documento',$datos->getTipo_documento());
$sql->bindValue(':edad',$datos->getEdad());
$sql->bindValue(':afiliacion',$datos->getPlan_afiliacion());
$sql->bindValue(':aseguradora',$datos->getAseguradora());
$sql->bindValue(':regimen',$datos->getRegimen());
$sql->bindValue(':sexo',$datos->getSexo());
$sql->bindValue(':fecha',$sub_fech);
$sql->bindValue(':hora',$datos->getHora());
$sql->bindValue(':ced_medico',$datos->getCed_medico());
$sql->bindValue(':consultorio',$datos->getConsultorio());
$sql->bindValue(':tipo_examen',$datos->getTipo_examen());
$sql->bindValue(':cod_examen',$datos->getCod_examen());
$sql->bindValue(':sede',$datos->getSede());
$sql->bindValue(':id_estado',$datos->getId_estado()); 
$sql->bindValue(':esquema_clinico',$datos->getEsquema_clinico());
$sql->execute();
return $this->conexion->lastInsertId();
}

public function Guardar_Cita_Extraordinaria($nombre_p,$apellido_p,$documento,$tipo_documento,$edad,$afiliacion,$aseguradora,$regimen,$sexo,$fecha,$hora,$ced_medico,$consultorio,$tipo_examen,$cod_examen,$sede,$id_estado,$esquema_clinico){
    $datos = new Cita($nombre_p,$apellido_p,$documento,$tipo_documento,$edad,$afiliacion,$aseguradora,$regimen,$sexo,$fecha,$hora,$ced_medico,$consultorio,$tipo_examen,$cod_examen,$sede,$id_estado,$esquema_clinico);
    $consulta = "INSERT INTO cita(nombre_paciente,apellido_paciente,documento,tipo_documento,edad,plan_afiliacion,aseguradora,regimen,sexo,fecha,hora,ced_medico,consultorio,tipo_examen,cod_examen,sede,id_estado,esquema_clinico) 
VALUES(:nombre_p,:apellido_p,:documento,:tipo_documento,:edad,:afiliacion,:aseguradora,:regimen,:sexo,:fecha,:hora,:ced_medico,:consultorio,:tipo_examen,:cod_examen,:sede,:id_estado,:esquema_clinico)";    
$sql = $this->conexion->prepare($consulta);
$sql->bindValue(':nombre_p',$datos->getNombre_paciente());
$sql->bindValue(':apellido_p',$datos->getApellido_paciente());
$sql->bindValue(':documento',$datos->getDocumento());
$sql->bindValue(':tipo_documento',$datos->getTipo_documento());
$sql->bindValue(':edad',$datos->getEdad());
$sql->bindValue(':afiliacion',$datos->getPlan_afiliacion());
$sql->bindValue(':aseguradora',$datos->getAseguradora());
$sql->bindValue(':regimen',$datos->getRegimen());
$sql->bindValue(':sexo',$datos->getSexo());
$sql->bindValue(':fecha',$datos->getFecha());
$sql->bindValue(':hora',$datos->getHora());
$sql->bindValue(':ced_medico',$datos->getCed_medico());
$sql->bindValue(':consultorio',$datos->getConsultorio());
$sql->bindValue(':tipo_examen',$datos->getTipo_examen());
$sql->bindValue(':cod_examen',$datos->getCod_examen());
$sql->bindValue(':sede',$datos->getSede());
$sql->bindValue(':id_estado',$datos->getId_estado()); 
$sql->bindValue(':esquema_clinico',$datos->getEsquema_clinico());
$sql->execute();
return $this->conexion->lastInsertId();
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

public function Listar_Agenda(){
    $consulta = "SELECT * FROM cita where fecha=Now()";
    foreach ($this->conexion->query($consulta) as $row) {
        print $row['id_cita'] . "\t";
        print $row['nombre_paciente'] . "\t";
        print $row['edad'] . "\n";
    }
}

public function Consultar_Cita_por_Id($id){
    $sq="SELECT * FROM cita as cit WHERE cit.id_cita= :id";
$result=$this->conexion->prepare($sq);
$result->execute(array(
':id' =>"".$id.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["id_cita"];
        $cont++;
        $dir[$cont] = $fila["nombre_paciente"];
        $cont++;
        $dir[$cont] = $fila["apellido_paciente"];
        $cont++;
        $dir[$cont] = $fila["documento"];
        $cont++;
        $dir[$cont] = $fila["edad"];
        $cont++;
        $dir[$cont] = $fila["plan_afiliacion"];
        $cont++;
        $dir[$cont] = $fila["aseguradora"];
        $cont++;
        $dir[$cont] = $fila["regimen"];
        $cont++;
        $dir[$cont] = $fila["fecha"];
        $cont++;
        $dir[$cont] = $fila["hora"];
        $cont++;
        $dir[$cont] = $fila["ced_medico"];
        $cont++;
        $dir[$cont] = $fila["consultorio"];
        $cont++;
        $dir[$cont] = $fila["tipo_examen"];
        $cont++;
        $dir[$cont] = $fila["cod_examen"];
        $cont++;
        $dir[$cont] = $fila["sede"];
        $cont++;
        $dir[$cont] = $fila["esquema_clinico"];
        $cont++;
        $dir[$cont] = $fila["id_estado"];
        $cont++;
        $dir[$cont] = $fila["tipo_documento"];
        $cont++;
        $dir[$cont] = $fila["sexo"];
        $cont++;
endforeach;
return $dir;
}

public function Consultar_Cita($id_cita, $id_consentimiento){
    $sq="SELECT cita.documento,cita.tipo_documento,cons.nombre FROM cita as cita, cita_consent as cit, consentimiento_detalle as cons WHERE cita.id_cita=cit.id_cita and cons.cod_consentimiento=cit.cod_consentimiento and cit.id_cita= :id_cita and cit.cod_consentimiento= :id_consentimiento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
':id_cita' =>"".$id_cita."",
':id_consentimiento' =>"".$id_consentimiento.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["documento"];
        $cont++;
        $dir[$cont] = $fila["tipo_documento"];
        $cont++;
        $dir[$cont] = $fila["nombre"];
        $cont++;
endforeach;
return $dir;
}

public function Consultar_Estado_cita($id_cita){
    $sq="SELECT * FROM cita as cit WHERE cit.id_cita= :id_cita";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':id_cita' =>"".$id_cita.""
      ));
    $results = $result -> fetchAll();   
    foreach($results as $fila):
            $estado = $fila["id_estado"];
    endforeach;
        return $estado;
}

public function Consultar_Cita2($id_cita, $id_consentimiento){
    $sq="SELECT cita.documento,cita.tipo_documento,cons.descripcion FROM cita as cita, cita_consent as cit, consentimiento as cons WHERE cita.id_cita=cit.id_cita and cons.codigo=cit.cod_consentimiento and cit.id_cita= :id_cita and cit.cod_consentimiento= :id_consentimiento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
':id_cita' =>"".$id_cita."",
':id_consentimiento' =>"".$id_consentimiento.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["documento"];
        $cont++;
        $dir[$cont] = $fila["tipo_documento"];
        $cont++;
        $dir[$cont] = $fila["descripcion"];
        $cont++;
endforeach;
return $dir;
}

public function Consultar_Inquietudes_Respuesta($id_cita, $id_consentimiento){
    $sq="SELECT cit.inquietud, cit.respuesta FROM cita_consent as cit WHERE  cit.id_cita= :id_cita and cit.cod_consentimiento= :id_consentimiento";
$result=$this->conexion->prepare($sq);
$result->execute(array(
':id_cita' =>"".$id_cita."",
':id_consentimiento' =>"".$id_consentimiento.""
));
$results = $result -> fetchAll();
$dir = array();
$cont = 0;
foreach($results as $fila):
        $dir[$cont] = $fila["inquietud"];
        $cont++;
        $dir[$cont] = $fila["respuesta"];
        $cont++;
endforeach;
return $dir;
}

public function Agregar_Consentimiento_Cita($id_cita,$cod_consentimiento,$id_estado){
    $consulta = "INSERT INTO cita_consent(id_cita,cod_consentimiento,id_estado) 
    VALUES(:id_cita,:cod_consentimiento,:id_estado)";       
    $sql = $this->conexion->prepare($consulta);     
    $sql->bindValue(':id_cita',$id_cita);
    $sql->bindValue(':cod_consentimiento',$cod_consentimiento);
    $sql->bindValue(':id_estado',$id_estado);  
    $sql->execute();

}

public function Cita_No_Asistida($id_cita){

    $sq ="UPDATE cita SET id_estado= 5 WHERE id_cita= :id_cit";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':id_cit' =>"".$id_cita.""
      ));
      return $result->rowCount();
}

public function Actualizar_Medico_Cita($id_cit,$documento,$tipo_documento,$sexo){

    $sq ="UPDATE cita SET ced_medico=:ced_medico, tipo_documento=:tipo_documento, sexo=:sexo WHERE id_cita= :id_cita";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':ced_medico' =>"".$documento."",
        ':tipo_documento' =>"".$tipo_documento."",
        ':sexo' =>"".$sexo."",
        ':id_cita' =>"".$id_cit."",
      ));
      return $result->rowCount();
}

public function Actualizar_Info_Cita($id_cit,$tipo_documento,$sexo){

    $sq ="UPDATE cita SET tipo_documento=:tipo_documento, sexo=:sexo WHERE id_cita= :id_cita";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':tipo_documento' =>"".$tipo_documento."",
        ':sexo' =>"".$sexo."",
        ':id_cita' =>"".$id_cit."",
      ));
      return $result->rowCount();
}

public function Actualizar_Cita_($id_cita,$tipo_documento,$sexo){
    $sq ="UPDATE cita SET tipo_documento=:tipo_documento, sexo=:sexo WHERE id_cita= :id_cita";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':tipo_documento' =>"".$tipo_documento."",
        ':sexo' =>"".$sexo."",
        ':id_cita' =>"".$id_cita."",
      ));
      return $result->rowCount();
}

public function Actualizar_Cita_Sexo($id_cita,$sexo){
    $sq ="UPDATE cita SET sexo=:sexo WHERE id_cita= :id_cita";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':sexo' =>"".$sexo."",
        ':id_cita' =>"".$id_cita."",
      ));
      return $result->rowCount();
}

public function Eliminar_Consentimientos_Cita($id_cita){
    $sq = "DELETE FROM cita_consent WHERE id_cita= :id_cita";
    $result=$this->conexion->prepare($sq);
    $result->execute(array(
        ':id_cita' =>"".$id_cita.""
      ));
      return $result ;
}



public function listar_citas_Pendientes(){

    try{
        $query = $this->conexion->prepare('SELECT COUNT(id_cita) AS cantidad_total FROM cita WHERE id_estado=3 and fecha = CURDATE();');
        $query->execute();
        $resultado = $query->fetch();
        return $resultado;
    }catch(PDOException $e){
        return false;
    }


}
public function listar(){ 
    try{    
        $resultado = "SELECT * FROM cita where fecha = curdate() order by hora ASC";
        return $resultado;   
    }catch(PDOException $e){
        return false;
    }
}

public function Validar_Estado_Cita_Sin_Pendientes($id_cita){
    $sq="SELECT COUNT(citcon.cod_consentimiento) as total FROM cita_consent as citcon WHERE citcon.id_estado=10 and citcon.id_cita=:id_cita";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':id_cita' =>"".$id_cita.""
  ));
$results = $result -> fetchAll();
foreach($results as $fila):
        $cantidad = $fila["total"];
endforeach;
    return $cantidad;
}

public function Validar_Consentimientos_Con_Preguntas($id_cita,$inquietud,$respuesta){
    $sq="SELECT COUNT(citcon.cod_consentimiento) as total FROM cita_consent as citcon WHERE (citcon.inquietud!=:inquietud or citcon.respuesta!=:respuesta) and citcon.id_cita=:id_cita";
$result=$this->conexion->prepare($sq);
$result->execute(array(
    ':inquietud' =>"".$inquietud."",
    ':respuesta' =>"".$respuesta."",
    ':id_cita' =>"".$id_cita.""
  ));
$results = $result -> fetchAll();
foreach($results as $fila):
        $cantidad = $fila["total"];
endforeach;
    return $cantidad;
}
}
?>