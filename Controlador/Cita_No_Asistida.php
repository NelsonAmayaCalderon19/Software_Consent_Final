<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location: ../index.php");
  }
  ?>
<?php
include_once '../Conexion/Conexion.php'; 
require '../modelo/Cita.php';
include_once '../modelDao/CitaDao.php';

$cita = new CitaDao();

$id_cita = $_GET["id_cita"];
$res = $cita->Cita_No_Asistida($id_cita);

if($cita){
    $cita->Eliminar_Consentimientos_Cita($id_cita);
    header("location:../principal.php");
}

?>
 