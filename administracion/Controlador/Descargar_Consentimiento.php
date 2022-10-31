<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
  <?php 
      include_once '../../Conexion/Conexion.php';
      require '../../modelo/Consentimiento.php';
      include_once '../../modelDao/ConsentimientoDao.php';
      $consentimiento = new ConsentimientoDao();

$id_consentimiento = $_GET["cod_consentimiento"];

$datos = $consentimiento->Consultar_Consentimiento_Formato($id_consentimiento);
//$dato = "../../formatos/". $datos[1];
$archivo_binario = (file_get_contents('../../formatos/'. $datos[1]));
//$formulario = $consentimiento->Consultar_Formulario_Consentimiento($id_consentimiento);
//header("location:../formulario_consentimiento.php"  . "?id_cita=" . $id_cita ."&cod_consentimiento=" . $id_consentimiento . "&cod_examen=" .$cod_examen);
header("Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document"); 
header('Content-Disposition: attachment; filename="'.$datos[1].'.docx"');
echo $archivo_binario;

?>