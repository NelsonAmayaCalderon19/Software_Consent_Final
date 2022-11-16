<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Validar Login</title>
	<meta charset="utf-8">
</head>
<body>
<?php 

try{
	include_once '../Conexion/Conexion.php'; 
require '../modelo/Usuario.php';
require '../modelo/Profesional.php';
include_once '../modelDao/UsuarioDao.php';
$usuario = new UsuarioDao();
$documento=htmlentities(addslashes($_GET["documento"]));
$password=htmlentities(addslashes($_GET["password"]));
$resul = $usuario->validar_login($documento,$password);
$res = $usuario->Datos_Usuario($documento);

if ($resul!=0) {
	session_start();
	$_SESSION["usuario"]=$res;
	$_SESSION["nombre_repres"] = "";
	header("location:../principal.php");
}else{
	 header("Location: ../index.php?error=true");
     //echo "Error";
}
}catch(Exception $e){
    die("Error " . $e.getMessage());
    }

?>
</body>
</html>