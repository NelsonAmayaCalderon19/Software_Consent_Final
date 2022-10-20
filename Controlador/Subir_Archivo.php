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
include_once '../modelDao/CitaDao.php';
require '../modelo/Consentimiento.php';
include_once '../modelDao/ConsentimientoDao.php';
include_once '../js/script_sweet.js';


$conexion = new conexion();
$conexion = $conexion->connect();
$cita = new CitaDao();
$consent = new ConsentimientoDao();
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

    while(($datos = fgetcsv($archivo, null, ",")) !== false) {
        
        if ($con >0 and $con<$lineas-3 ) {
        // Lee y muestra los datos del archivo.
        /*echo "DATOS DEL USUARIO: ".$con."<br>";
        echo "Apellidos: ".$datos[0]."<br>";
        echo "Nombres: ".$datos[1]."<br>";
        echo "Documento: ".$datos[2]."<br>";
        echo "Edad: ".$datos[3]."<br>";
        echo "Contrato: ".$datos[5]."<br>";
        echo "Plan: ".$datos[6]."<br>";
        echo "Aseguradora: ".$datos[7]."<br>";
        echo "Regimen: ".$datos[8]."<br>";
        echo "Fecha: ".$datos[9]."<br>";
        echo "Hora: ".$datos[10]."<br>";
        echo "Consultorio: ".$datos[11]."<br>";
        echo "Examen: ".$datos[17]."<br>";

        echo "<br>";*/
        //$fecha = "CURDATE() + INTERVAL 1 DAY";
        $cod_examen= $cita->Consultar_Cod_Examen($datos[17]);
        $cod = $cita->Guardar_Cita($datos[1],$datos[0],$datos[2],"",$datos[3],$datos[6],$datos[7],$datos[8],"",$datos[9],$datos[10],$datos[14],$datos[11],$datos[16],$cod_examen,$datos[19],3,$datos[15]);
        //$nombre_p,$apellido_p,$documento,$edad,$afiliacion,$aseguradora,$regimen,$fecha,$hora,$ced_medico,$consultorio,$tipo_examen,$cod_examen,$sede,$id_estado,$esquema_clinico
        $sq="SELECT * FROM consent_examen as exam WHERE exam.cod_examen= :id";
        $result=$conexion->prepare($sq);
        $result->execute(array(
        ':id' =>"".$cod_examen.""
        ));
        $results = $result -> fetchAll();
        $dir = array();
        $cont = 0;
        foreach($results as $fila):   
          $estad = $consent->Consultar_Estado_Consentimiento($fila["cod_consentimiento"]);
          if($estad=="1") {
          $cita->Agregar_Consentimiento_Cita($cod,$fila["cod_consentimiento"],6);
          }
        endforeach;
        }if($cita){
          

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
            echo "No se Inserto";
            }
    
    $con++;
    }
    unlink($directorio.'/'.$archivo_nombre);
    fclose($archivo);
}
?>