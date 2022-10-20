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

    <title>Anexar Consentimiento</title>
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
$cod_examen = $_GET['cod_examen'];
      ?>
<?php include "includes/header.php";?>
<div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
          <div class="col-sm-12 card shadow mb-3">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o"></i> Ingresar Información</h6>
            </div>
            <div class="col-sm-12 card-body">
            <form method="post" action="Controlador/Anexar_Consentimiento_Examen.php">
            <label for="validationCustomNombre">Codigo Examen <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-code"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $cod_examen; ?>" name="codigo_examen" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<?php $listar_consentimientos = "select con.codigo,con.descripcion from consentimiento as con where not exists (select * from consent_examen as conexam where con.codigo=conexam.cod_consentimiento and conexam.cod_examen =$cod_examen)";?>
<label for="validationCustomResponsable">Seleccione los consentimientos Relacionados con el Examen <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
<div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-files-o"></i></span>
  </div>
    <select class="custom-select" id="validationCustomResponsable" name="selectconsentimiento[]" aria-describedby="inputGroupPrepend" multiple required=""> 
    <option value="" disabled>Seleccione los Consentimientos Disponibles</option>
    <?php foreach ($conexion->query($listar_consentimientos) as $row) { ?>
    <option value="<?php echo $row['codigo']; ?>"><?php echo $row['descripcion']; ?></option>
                                <?php }?>
  </select></div>
  <div class="col-12 text-center justify-content-center row ">
  <a class="btn btn-warning mr-2" href="informacion_examen.php?cod_examen=<?php echo $cod_examen; ?>">Cancelar</a>
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
<?php include "includes/footer.php";?>
</body>
</html>