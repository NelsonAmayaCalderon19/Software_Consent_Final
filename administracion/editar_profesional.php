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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style>
  #customFile .custom-file-control:lang(en)::after {
  content: "Selecciona la imagen";
}

#customFile .custom-file-control:lang(en)::before {
  content: "Click Aquí";
}

/*when a value is selected, this class removes the content */
.custom-file-control.selected:lang(en)::after {
  content: "" !important;
}

.custom-file {
  overflow: hidden;
}
.custom-file-control {
  white-space: nowrap;
}
  </style>
    <title>Editar Profesional</title>
    <?php
session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
</head>
    <body onload="mostrar()">
    <?php 
      include_once '../Conexion/Conexion.php'; 
      require '../modelo/Profesional.php';
include_once '../modelDao/ProfesionalDao.php';
$profesional = new ProfesionalDao();
      $conexion = new conexion();
$conexion = $conexion->connect();
$documento = $_GET["documento"];
$datos = $profesional->Consultar_Datos_Profesional($documento); 
$datosCargo = $profesional->Obtener_Cargo_profesional($documento);
      ?>
<?php include "includes/header.php";?>
<div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
          <div class="col-sm-12 card shadow mb-3">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o"></i> Actualizacion de Datos Personales</h6>
            </div>
            <div class="col-sm-12 card-body">
            <form method="post" action="Controlador/Actualizar_Datos_Profesional.php" enctype="multipart/form-data">
            <label for="validationCustomNombre">Nombre Completo <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[1]; ?>" name="nombre_completo" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomNombre">Documento de Identidad <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[0]; ?>" name="documento" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<?php $consul_cargo = "SELECT * FROM cargo";?>
<label for="validationCustomSelect">Cargo del Profesional<span style="color:red;"> (*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-user"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectcargo" aria-describedby="inputGroupPrepend" required onchange="mostrar()">   
         <option value="<?php echo $datos[2]; ?>" ><?php echo $datosCargo[0]; ?></option>
         <?php foreach ($conexion->query($consul_cargo) as $ro) { ?>
                        <option value="<?php echo $ro['id']; ?>"><?php echo $ro['descripcion'];?></option>
                        <?php } ?>  
              
  </select>
</div> 

<div class="container-fluid col-sm-12" style="display: none;" id="user">
<br>
<label for="validationCustomNombre">Re-Asignar Contraseña</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-key"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="password" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
         </div>
     

    <div class="container-fluid col-sm-12" style="display: none;" id="prof">
    <br>
    <label for="validationCustomNombre">Actualizar Firma</label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon3"><i class="fa fa-key"></i></span>
      </div>
      <div class="custom-file">
    <label class="custom-file" id="customFile">
        <input type="file" accept="image/png,image/jpeg" class="custom-file-input" id="exampleInputFile" aria-describedby="fileHelp" name="firma">
        <span class="custom-file-control form-control-file"></span>
    </label>
</div>
    </div>
  </div>
  
  <br><br>
  <div class="col-12 text-center justify-content-center row">
    <a class="btn btn-warning mr-3" href="personal.php">Volver</a>
<input class="btn btn-success btn-acepta" type="submit" name="btnAcepta" value="Actualizar" /> 
    
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
    <script src="js/editar_profesionl.js"></script>
<?php include "includes/footer.php";?>
</body>
</html>