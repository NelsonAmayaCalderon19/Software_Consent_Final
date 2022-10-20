<!DOCTYPE html>
<html lang="en">
<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="../images/pestania.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Nelson Eduardo Amaya Calderón">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <title>Registrar Profesional</title>
    <?php
session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
</head>
    <body>
    <?php 
      include_once '../Conexion/Conexion.php'; 
      $conexion = new conexion();
$conexion = $conexion->connect(); 
      ?>
<?php include "includes/header.php";?>
<div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
          <div class="col-sm-12 card shadow mb-3">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o"></i> Ingresar Datos Personales</h6>
            </div>
            <div class="col-sm-12 card-body">
            <form method="post" action="Controlador/Agregar_Profesional.php" enctype="multipart/form-data">
            <label for="validationCustomNombre">Nombre Completo <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="nombre_completo" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomNombre">Documento de Identidad <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="documento" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomNombre">Firma - Imagen <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01"><i class="fa fa-file-image-o"></i></span>
  </div>
  <div class="custom-file">
    <input type="file" accept="image/png,image/jpeg" class="custom-file-input" id="inputGroupFile01"
      aria-describedby="inputGroupFileAddon01" name="firma">
    <label class="custom-file-label" for="inputGroupFile01">Seleccionar Imagen</label>
  </div>
</div>
<?php $consul_cargo = "SELECT * FROM cargo";?>

<label for="validationCustomNombre" id="encabezado_persona_firmante">Cargo <span style="color:red;">(*)</span></label>
  <div class="input-group mb-3" id="cargo">
  <?php foreach ($conexion->query($consul_cargo) as $row) { ?>
  <div class="form-check col-md-3">
  <input class="form-check-input" type="radio" value="<?php echo $row['id']; ?>" name="radiocargo" id="radiocargo1" onchange="mostrar2(this.value);">
  <label class="form-check-label" for="flexRadioFirma1">
  <?php echo $row['descripcion'];?>
  </label>
  
</div>
<?php } ?> 
<div class="container-fluid col-sm-12" style="display:none;" id="password">
<br>
<label for="validationCustomNombre">Asignar Contraseña <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-key"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="password" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
  </div>
  <br><br>
  <div class="col-12 text-center justify-content-center row">
<input class="btn btn-success btn-acepta" type="submit" name="btnAcepta" value="Aceptar" /> 
    
                          </div>
            </form>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>   
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
function mostrar2(dato2) {
  if (dato2 == 3 || dato2 == 4) {
    document.getElementById("password").style.display = "block";
  }
  if(dato2 == 1 || dato2 == 2){
    document.getElementById("password").style.display = "none";
  }
}

    </script>
<?php include "includes/footer.php";?>
</body>
</html>