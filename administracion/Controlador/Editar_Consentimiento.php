<?php
session_start();
if (!isset($_SESSION["usuario"])) {
  header("location:../index.php");
}
?>
<?php
include_once '../../Conexion/Conexion.php'; 
require '../../modelo/Consentimiento.php';
include_once '../../modelDao/ConsentimientoDao.php';
$consentimiento = new ConsentimientoDao();

$id_consentimiento = $_GET["cod_consentimiento"];

header("location:../editar_consentimiento.php?cod_consentimiento=" . $id_consentimiento);


?>