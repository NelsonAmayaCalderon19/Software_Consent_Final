<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location: ../index.php");
  }
  ?>
<?php
include_once '../Conexion/Conexion.php'; 
require '../modelo/Cita.php';
require '../modelo/Examen.php';
require '../modelo/Profesional.php';
include_once '../modelDao/CitaDao.php';
require '../modelo/Consentimiento.php';
include_once '../modelDao/ConsentimientoDao.php';
require '../modelo/Estado.php';
include_once '../modelDao/EstadoDao.php';
include_once '../javaScript/script_sweet.js';


$conexion = new conexion();
$conexion = $conexion->connect();
$cita = new CitaDao();
$consent = new ConsentimientoDao();
$estado = new EstadoDao();
$cod_examen;
if(filter_input(INPUT_POST, 'btnCargar')){
    $archivo_nombre=$_FILES['archivo']['name'];
    $archivo_tipo = $_FILES['archivo']['type'];
    $archivo_temp = $_FILES['archivo']['tmp_name'];
    $directorio = 'archivo_agenda/';
    $subir_archivo = $directorio.basename($_FILES['archivo']['name']);
    move_uploaded_file($_FILES['archivo']['tmp_name'], $subir_archivo);
    $archivo = fopen($directorio.'/'.$archivo_nombre, "r");
    $filePath = $directorio.'/'.$archivo_nombre;
    $lineas = count(file($filePath));
    $con = -3;
    $agenda_valida = false;
    while(($datos = fgetcsv($archivo, null, ",")) !== false) {
        
        if ($con >0 and $con<$lineas-3 ) {
        $cod_examen= $cita->Consultar_Cod_Examen($datos[16]);
        $ced_profesional = $cita->Consultar_Cod_Profesional_Registrado($datos[12]);
        $resthora = date( "H:i", strtotime($datos[9]));
        $estado_cita = $estado->Consultar_Estado_Por_Descripcion($datos[17]);
        if($cod_examen!=""){
          if($ced_profesional!=""){
           if($estado_cita == 3){
            $fullname = str_replace('¥','Ñ', $datos[0]);
            $separar_fullname = explode(",", $fullname);
            $apellidos = $separar_fullname[0];
            $nombres = $separar_fullname[1];
            $apellidos_final = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $apellidos);
            $nombres_final = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $nombres);
            $esquema_clinico = str_replace('¡', 'í', $datos[14]);
            //Orden: Nombre_Paciente/Apellido_Paciente/Documento/tipo_documento/edad/afiliacion-plan/aseguradora/regimen/sexo/fecha/hora/ced_medico/consultorio/tipo_examen/cod_examen/sede/id_estado/esquema_clinico
        $cod = $cita->Guardar_Cita($nombres_final,$apellidos_final,$datos[1],"",$datos[2],$datos[5],$datos[6],$datos[7],"",$datos[8],$resthora,$datos[12],$datos[10],$datos[15],$cod_examen,$datos[20],3,$esquema_clinico);
        $sq="SELECT * FROM consent_examen as exam WHERE exam.cod_examen= :id";
        $result=$conexion->prepare($sq);
        $result->execute(array(
        ':id' =>"".$cod_examen.""
        ));
        $results = $result -> fetchAll();
        $dir = array();
        $cont = 0;
        foreach($results as $fila): 
          $agenda_valida=true;  
          $estad = $consent->Consultar_Estado_Consentimiento($fila["cod_consentimiento"]);
          if($estad=="1") {
          $cita->Agregar_Consentimiento_Cita($cod,$fila["cod_consentimiento"],6);
          }
        endforeach;
      }else{
        //$con++;
      }
      }else{
        //$con++;
      }
    }else{
      //$con++;
    }
        }
    
    $con++;
    }
    if($agenda_valida == true){
      echo '<script>
      Swal.fire({
       icon: "success",
       title: "Proceso Exitoso",
       text: "La Agenda se Añadió con Exito al Sistema",
       showConfirmButton: true,
       confirmButtonText: "Cerrar"
       }).then(function(result){
          if(result.value){                   
           window.location = "../principal.php";
          }
       });
      </script>';
    }else{
      echo '<script>
      Swal.fire({
       icon: "error",
       title: "Error al Procesar",
       text: "Verifique la estructura del Archivo o Agenda Vacia",
       showConfirmButton: true,
       confirmButtonText: "Cerrar"
       }).then(function(result){
          if(result.value){                   
           window.location = "../cargar_agenda.php";
          }
       });
      </script>';
    }
    unlink($directorio.'/'.$archivo_nombre);
    fclose($archivo);
}
?>