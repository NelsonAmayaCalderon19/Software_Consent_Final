<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="images/pestania.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
	<title>añadir Inquietud</title>
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
      require 'modelo/Cita.php';
      include_once 'modelDao/CitaDao.php';
      require 'modelo/Profesional.php';
      include_once 'modelDao/ProfesionalDao.php';
      require 'modelo/Examen.php';
      include_once 'modelDao/ExamenDao.php';     
      $cita = new CitaDao();
      $prof = new ProfesionalDao();
      $examen = new ExamenDao();
      $id_cita = $_GET["id_cita"];
      $id_consentimiento = $_GET["cod_consentimiento"];
      $cod_examen = $_GET["cod_examen"];
     // $datos = $cita->Consultar_Cita_por_Id($id_cita);
require 'modelo/Consentimiento.php';
include_once 'modelDao/ConsentimientoDao.php';
$consentimiento = new ConsentimientoDao();
$conexion = new conexion();
$conexion = $conexion->connect(); 
include "includes/header.php";?>
<div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
              <div class="col-12 d-xl-flex align-items-center justify-content-center" style="width:100%;">
                <div class="alert alert-success alert-dismissible" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Responda a las Preguntas Dadas a conocer por el Paciente</strong> respecto al Procedimiento a Realizar
  </div>
                </div>
                <div class="col-sm-12 card shadow mb-3">
            <div class="card-header py-3">
            <?php $nombre_proced = $consentimiento->Consultar_Nombre_Consentimiento($id_consentimiento); ?>
              <h6 class="m-0 text-black"><i class="fa fa-pencil-square-o" style="color: #007bff;"></i> <?php echo $nombre_proced; ?></h6>
            </div>
            <div class="col-sm-12 card-body">
            <form method="POST" id="formularito" action="Controlador/Crear_Consentimiento2.php?id_cita=<?php echo $id_cita?>&cod_consentimiento=<?php echo $id_consentimiento?>&cod_examen=<?php echo $cod_examen?>&borrar_archivo=true">
            <?php
      $datos = $cita->Consultar_Inquietudes_Respuesta($id_cita,$id_consentimiento);
?>
            <label for="validationCustomNombre"><strong>Inquietudes del Paciente</strong></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-question"></i></span>
  </div>
  <?php if($datos[0]==""){?>
    <textarea class="form-control" style="height: 6em;"  name="inquietudes" id="validationCustomNombre" aria-describedby="basic-addon3" required=""></textarea>
<?php }else{?>
    <textarea class="form-control" style="height: 6em;"  name="inquietudes" id="validationCustomNombre" aria-describedby="basic-addon3" required="" readonly=""><?php echo $datos[0];?></textarea>
<?php }?>
</div>
<label for="validationCustomNombre"><strong>Respuesta del Medico Tratante</strong></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-comment-o"></i></span>
  </div>
    <textarea class="form-control" style="height: 6em;"  name="respuesta" id="validationCustomNombre" aria-describedby="basic-addon3" required=""><?php echo $datos[1];?></textarea>
</div>
      </div>                        
      <div class="modal-footer">
      <a class="btn btn-warning mr-3" style="color: white;" href="<?php echo "ver_consentimientos.php?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen. "&historial=false". "&solicitar=false" ?>">Cancelar</a>
        <input class="btn btn-success btn-acepta2" type="submit" name="btnAcepta2" id="btnAcepta2" value="Finalizar" /> 
 
      </div>

</form>
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>   
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
//$(document).ready(function() {
          
          //$("#success-alert").fadeTo(3000, 1000).slideUp(1000, function() {
      //$("#success-alert").slideUp(1000);
      //});
      //});
      
      $(".custom-select option").each(function() {
      $(this).siblings('[value="'+ this.value +'"]').remove();
      });
        </script>
</body>
</html>