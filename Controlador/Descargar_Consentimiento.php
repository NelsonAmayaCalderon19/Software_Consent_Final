<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
<?php 
      include_once '../Conexion/Conexion.php';
      require '../modelo/Consentimiento.php';
      include_once '../modelDao/ConsentimientoDao.php';
      require '../modelo/Cita.php';
      include_once '../modelDao/CitaDao.php';
      $consentimiento = new ConsentimientoDao();
      $cita = new CitaDao();
    
$id_cita = $_GET["id_cita"];
$id_consentimiento = $_GET["cod_consentimiento"];
$cod_examen = $_GET["cod_examen"];
$datos = $consentimiento->Consultar_Consentimiento_Paciente($id_cita,$id_consentimiento);
if($_GET["cod_consentimiento"] != "9. FT-PA-GI-HC-064"){
$nombre = $cita->Consultar_Cita($id_cita,$id_consentimiento);}
else{
  $nombre = $cita->Consultar_Cita2($id_cita,$id_consentimiento);
  
}
$tipo_doc = $nombre[1];
if($tipo_doc=="Cedula de Ciudadania"){
  $tipo_doc = "CC";
}else if($tipo_doc=="Cedula de Extranjeria"){
  $tipo_doc = "CE";
}else if($tipo_doc=="Permiso Especial de Permanencia"){
  $tipo_doc = "PEP";
}else if($tipo_doc=="Registro Civil"){
  $tipo_doc = "RC";
}else if($tipo_doc=="Tarjeta de Identidad"){
  $tipo_doc = "TI";
}else if($tipo_doc=="Pasaporte"){
  $tipo_doc = "PA";
}else{
  $tipo_doc = $nombre[1];
}


//$formulario = $consentimiento->Consultar_Formulario_Consentimiento($id_consentimiento);
//header("location:../formulario_consentimiento.php"  . "?id_cita=" . $id_cita ."&cod_consentimiento=" . $id_consentimiento . "&cod_examen=" .$cod_examen);
header("Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document"); 
header('Content-Disposition: attachment; filename="Consentimiento Informado de '.$nombre[2].' -'.$tipo_doc.'_'.$nombre[0].'.docx"');
 
//imprimir el archivo
echo $datos[2];

?>