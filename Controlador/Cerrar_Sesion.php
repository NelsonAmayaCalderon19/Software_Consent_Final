<!DOCTYPE html>
<html>
<head>
	<title>Cerrar Sesión</title>
</head>
<body>
<?php 
session_start();
session_destroy();
header("location:../index.php");
 ?>
</body>
</html>