<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
<?php 
      include_once '../Conexion/Conexion.php';
      require '../modelo/Cita.php';
      require '../modelo/Consentimiento.php';
      include_once '../modelDao/ConsentimientoDao.php';
      $consentimiento = new ConsentimientoDao();
    
$id_cita = $_GET["id_cita"];
$id_consentimiento = $_GET["cod_consentimiento"];
$cod_examen = $_GET["cod_examen"];
//$formulario = $consentimiento->Consultar_Formulario_Consentimiento($id_consentimiento);
header("location:../formulario_consentimiento.php"  . "?id_cita=" . $id_cita ."&cod_consentimiento=" . $id_consentimiento . "&cod_examen=" .$cod_examen);

?>