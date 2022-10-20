<!DOCTYPE html>
<html lang="en">
<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="images/pestania.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Nelson Eduardo Amaya Calderón">
 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
  

    <title>Crear Cita</title>
    <?php
    session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>

</head>
    <body>
    <?php 
      include_once 'Conexion/Conexion.php'; 
      $conexion = new conexion();
$conexion = $conexion->connect(); 
      ?>
    <?php include "includes/header.php";?>
    <div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
          <div class="col-sm-12 card shadow mb-3">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o"></i> Ingresar Información</h6>
            </div>
            <div class="col-sm-12 card-body">
            <form method="post" action="Controlador/Confirmar_Cita.php">
            <label for="validationCustomNombre">Nombres del Paciente <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="nombres_paciente" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomNombre">Apellidos del Paciente <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="apellidos_paciente" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomNombre">Numero de Documento <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="documento" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomSelect">Tipo de Documento <span style="color:red;">(*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-address-card"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selecttipodocumento" aria-describedby="inputGroupPrepend" required>
                        <option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
                        <option value="Cedula de Extranjeria">Cedula de Extranjeria</option>  
                        <option value="Permiso Especial de Permanencia">Permiso Especial de Permanencia</option>   
                        <option value="Registro Civil">Registro Civil</option>
                        <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>      
                        <option value="Pasaporte">Pasaporte</option>       
  </select>
</div>
<label for="validationCustomNombre">Edad <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="edad" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomNombre">Afiliacion <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-shield"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="afiliacion" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomNombre">Aseguradora <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-shield"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="aseguradora" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
<label for="validationCustomSelect">Regimen <span style="color:red;">(*)</span></label>

     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-users"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectregimen" aria-describedby="inputGroupPrepend" required>
         
                        <option value="Contributivo">Contributivo</option>
                        <option value="Subsidiado">Subsidiado</option>
                        <option value="Particular">Particular</option>
                        <option value="SOAT">SOAT</option>
                        <option value="Seguro de Riesgos Catastróficos y Accidentes de Tránsito (ECAT)">Seguro de Riesgos Catastróficos y Accidentes de Tránsito (ECAT)</option>
                        <option value="VINC">VINC</option>
                    </select>
</div>
<label for="validationCustomSelect">Sexo <span style="color:red;">(*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-address-card"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectsexo" aria-describedby="inputGroupPrepend" required>
                    
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>  
                        <option value="Otro / No Responde">Otro / No Responde</option>         
  </select>
</div>
<label for="validationCustomNombre">Fecha <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-calendar"></i></span>
  </div>
    <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" name="fecha" id="validationCustomNombre" aria-describedby="basic-addon3" >
</div>
<label for="validationCustomNombre">Hora <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-clock-o"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="hora" id="validationCustomNombre" aria-describedby="basic-addon3" >
</div>
<?php $consul_cargo = "SELECT * FROM examen where id_estado=1";?>
<label for="validationCustomSelect">Examen <span style="color:red;"> (*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-medkit"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectexamen" aria-describedby="inputGroupPrepend" required>
         <?php foreach ($conexion->query($consul_cargo) as $ro) { ?>
                        <option value="<?php echo $ro['codigo']; ?>"><?php echo $ro['descripcion'];?></option>
                        <?php } ?>  
              
  </select>
</div>
<label for="validationCustomSelect">Tipo de Examen <span style="color:red;">(*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-stethoscope"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selecttipoexamen" aria-describedby="inputGroupPrepend" required>
                    
                        <option value="Procedimiento">Procedimiento</option>
                        <option value="Control">Control</option>  
                        <option value="Primera Vez">Primera Vez</option>         
  </select>
</div>
<?php $consul_cargo = "SELECT * FROM profesional where id_estado=1 and id_cargo=1";?>
<label for="validationCustomSelect">Medico <span style="color:red;"> (*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-user-md"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectmedico" aria-describedby="inputGroupPrepend" required>
         <?php foreach ($conexion->query($consul_cargo) as $ro) { ?>
                        <option value="<?php echo $ro['documento']; ?>"><?php echo $ro['nombre_completo'];?></option>
                        <?php } ?>  
              
  </select>
</div>
<label for="validationCustomSelect">Consultorio <span style="color:red;">(*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-stethoscope"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectconsultorio" aria-describedby="inputGroupPrepend" required>
                    
                        <option value="SALA 1">SALA 1</option>
                        <option value="SALA 2">SALA 2</option>  
                        <option value="SALA 3">SALA 3</option>         
  </select>
</div>
<label for="validationCustomSelect">Sede <span style="color:red;">(*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-hospital-o"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectsede" aria-describedby="inputGroupPrepend" required>
                    
                        <option value="Principal">Principal</option>
                        <option value="Otra">Otra</option>        
  </select>
         </div>
         <label for="validationCustomSelect">Esquema Clínico <span style="color:red;">(*)</span></label>

     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-hospital-o"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectesquema" aria-describedby="inputGroupPrepend" required>
                        <option value="">Seleccione</option>
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
</div>
         <div class="col-12 text-center justify-content-center row">

<input class="btn btn-success btn-acepta" type="submit" name="btnAcepta" value="Confirmar" /> 
    
                          </div>
                         
                          
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
<?php include "includes/footer.php";?>
</body>
</html>