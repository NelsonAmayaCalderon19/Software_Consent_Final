<!DOCTYPE html>
<html lang="en">
<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="../images/pestania.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
	<title>Formulario Consentimiento</title>
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
$conexion = new conexion();
$conexion = $conexion->connect(); 
$id_consentimiento = $_GET["cod_consentimiento"];
$consent = new ConsentimientoDao();
$consent_det = $consent->Consultar_Consentimiento_Detalles($id_consentimiento);
$consul_examen = "SELECT exam.descripcion,exam.codigo FROM examen as exam, consent_examen as excon where excon.cod_examen=exam.codigo and excon.cod_consentimiento='$id_consentimiento'";
$consul_todos_examen = "SELECT * FROM examen";
?>
    </head>
    <body>
     
    <?php include "includes/header.php";?>
    <div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
          <div class="col-sm-12 card shadow mb-3">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o"></i> Ingresar Información</h6>
            </div>
            <div class="col-sm-12 card-body">
            <form method="post" action="Controlador/Actualizar_Consentimiento.php">
            <label for="validationCustomNombre">Codigo del Consentimiento <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $consent_det[0]; ?>" name="codigo_consentimiento" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomSelect">Examen Relacionado <span style="color:red;">(*)</span></label>

     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-address-card"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectexamen[]" aria-describedby="inputGroupPrepend" multiple required>
         <?php foreach ($conexion->query($consul_examen) as $row) { ?>
                        <option value="<?php echo $row['codigo']; ?>" selected><?php echo $row['descripcion'];?></option>
                        <?php } ?>
                        <?php foreach ($conexion->query($consul_todos_examen) as $row) { ?>
                        <option value="<?php echo $row['codigo']; ?>"><?php echo $row['descripcion'];?></option>
                        <?php } ?>     
  </select>
</div>
            <label for="validationCustomNombre">Nombre del Procedimiento <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $consent_det[1]; ?>" name="nombre_procedimiento" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomNombre">Descripción del Procedimiento</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control"  name="descripcion" id="validationCustomNombre" style="height: 7em;" aria-describedby="basic-addon3"><?php echo $consent_det[2]; ?></textarea>
</div>
<label for="validationCustomNombre">Objetivo</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control"  name="objetivo" id="validationCustomNombre" style="height: 7em;" style="height: 10em;" aria-describedby="basic-addon3"><?php echo $consent_det[3]; ?></textarea>
</div>
<label for="validationCustomNombre">Beneficios</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control" name="beneficios" id="validationCustomNombre" style="height: 7em;" aria-describedby="basic-addon3"><?php echo $consent_det[4]; ?></textarea>
</div>
<label for="validationCustomNombre">Riesgos</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control" name="riesgos" id="validationCustomNombre" style="height: 10em;" aria-describedby="basic-addon3"><?php echo $consent_det[5]; ?></textarea>
</div>
<label for="validationCustomSelect">Existen otras Alternativas <span style="color:red;">(*)</span></label>

     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-address-card"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectalternativas" aria-describedby="inputGroupPrepend" required>
                        <option value="<?php echo $consent_det[6];?>" selected><?php echo $consent_det[6]; ?></option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
  </select>
</div>
<label for="validationCustomNombre">Alternativas</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control"  name="alternativas" style="height: 10em;" id="validationCustomNombre" aria-describedby="basic-addon3"><?php echo $consent_det[7]; ?></textarea>
</div>
<label for="validationCustomNombre">Decisión</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control" style="height: 10em;"  name="decision" id="validationCustomNombre" aria-describedby="basic-addon3"><?php echo $consent_det[8]; ?></textarea>
</div>
<label for="validationCustomNombre">Revocatoria</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control"  name="revocatoria" id="validationCustomNombre" style="height: 10em;" aria-describedby="basic-addon3"><?php echo $consent_det[9]; ?></textarea>
</div>
<label for="validationCustomSelect">Profesional que Firma <span style="color:red;">(*)</span></label>

     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-address-card"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectfirmante" aria-describedby="inputGroupPrepend" required>
                        <option value="<?php echo $consent_det[10];?>" selected><?php echo $consent_det[10]; ?></option>
                        <option value="MEDICO">Médico</option>
                        <option value="PERSONAL DE ENFERMERIA">Enfermero/a</option>
  </select>
</div>
<div class="col-12 text-center justify-content-center row">

<input class="btn btn-success btn-acepta" type="submit" name="btnAcepta" value="Aceptar" /> 
    
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
   $(".custom-select option").each(function() {
  $(this).siblings('[value="'+ this.value +'"]').remove();
});
  </script>
    <?php include "includes/footer.php";?>
</body>
</html>