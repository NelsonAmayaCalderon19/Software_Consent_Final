<!DOCTYPE html>
<html lang="en">
<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="images/pestania.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
  
  <style>
    .data{
    /*width: 100px;
    word-wrap: break-word;*/
    }
    </style>
	<title>Formulario Consentimiento</title>
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
      $datos = $cita->Consultar_Cita_por_Id($id_cita);
      
      

require 'modelo/Consentimiento.php';
include_once 'modelDao/ConsentimientoDao.php';
$consentimiento = new ConsentimientoDao();


$conexion = new conexion();
$conexion = $conexion->connect(); ?>
<?php include "includes/header.php";
if($_GET["cod_consentimiento"] != "FT-PA-GI-HC-064"){
$consulta = "SELECT * FROM consentimiento_detalle where cod_consentimiento = '$id_consentimiento'";?>
    
    <?php foreach ($conexion->query($consulta) as $row) { ?>
    <div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
              <div class="col-12 d-xl-flex align-items-center justify-content-center" style="width:100%;">
                <div class="alert alert-success alert-dismissible" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Consentimiento Informado</strong> Formato a Diligenciar
  </div>
                </div>
                <div class="col-sm-12 card shadow mb-3">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o"></i> Ingresar Información</h6>
            </div>
            <div class="col-sm-12 card-body">
            <form method="POST" id="formularito" action="Controlador/Crear_Consentimiento.php?id_cita=<?php echo $id_cita?>&cod_consentimiento=<?php echo $id_consentimiento?>&cod_examen=<?php echo $cod_examen?>"> 
            <label for="validationCustomNombre">Nombre del Paciente <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[1]; ?>" name="nombre_paciente" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>

<label for="validationCustomNombre">Apellidos del Paciente <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[2]; ?>" name="apellido_paciente" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomSelect">Tipo de Documento <span style="color:red;">(*)</span></label>
<?php $tipo_doc =$datos[17]; if($tipo_doc!=""){ ?>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[17]; ?>" name="selecttipodocumento" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<?php }else{?>
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
<?php }?>
<label for="validationCustomNombre">Documento <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[3]; ?>" name="documento" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomNombre">Aseguradora <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[6]; ?>" name="aseguradora" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomNombre">Regimen <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[7]; ?>" name="regimen" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomNombre">Edad <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[4]; ?>" name="edad" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomSelect">Sexo del Paciente <span style="color:red;">(*)</span></label>
<?php $sex =$datos[18]; if($sex!=""){ ?>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[18]; ?>" name="selectsexo" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<?php }else{?>
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
<?php }?>
<label for="validationCustomNombre">Fecha <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-calendar"></i></span>
  </div>
    <input type="date" class="form-control" value="<?php echo $datos[8]; ?>" name="fecha" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomNombre">Hora <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-clock-o"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[9]; ?>" name="hora" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<?php $datoscargo = $prof->Consultar_Cargo_por_Descripcion($row['profesional_firma']); 
$cargo = $datoscargo[0];?>
<?php $consul_cargo = "SELECT * FROM profesional as prof where prof.id_estado=1 and prof.id_cargo= $cargo";?>
<?php if($row['profesional_firma'] == "MEDICO"){ ?>
<label for="validationCustomSelect"><?php echo $row['profesional_firma']; ?><span style="color:red;"> (*)</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-user"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectprofesional" aria-describedby="inputGroupPrepend" required>
         <?php if($cargo == "1"){
          $datosprof = $prof->Consultar_Profesional_por_Cedula($datos[10]);?>
         <option value="<?php echo $datosprof[0]; ?>"><?php echo $datosprof[1]; ?></option>
         <?php }?>
         <?php foreach ($conexion->query($consul_cargo) as $ro) { ?>
                        <option value="<?php echo $ro['documento']; ?>"><?php echo $ro['nombre_completo'];?></option>
                        <?php } ?>  
              
  </select>
</div>
<?php }else{?>
  <label for="validationCustomSelect"><?php echo $row['profesional_firma']; ?><span style="color:red;"></span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-user"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectprofesional" aria-describedby="inputGroupPrepend" >
         <option value="">Seleccione</option>
         <?php foreach ($conexion->query($consul_cargo) as $ro) { ?>
                        <option value="<?php echo $ro['documento']; ?>"><?php echo $ro['nombre_completo'];?></option>
                        <?php } ?>  
              
  </select>
</div>

  <?php } ?>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th class="text-center" scope="col">NOMBRE DEL TRATAMIENTO O PROCEDIMIENTO PROPUESTO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  <td><?php echo nl2br($row['nombre']);?></td>
    </tr>
  </tbody>
  <thead class="thead-light">
    <tr>
      <th class="text-center" scope="col">DESCRIPCIÓN DEL TRATAMIENTO O PROCEDIMIENTO PROPUESTO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  <td><?php echo nl2br($row['descripcion']);?></td>
    </tr>
  </tbody>
  <thead class="thead-light">
    <tr>
      <th class="text-center" scope="col">OBJETIVO DEL TRATAMIENTO O PROCEDIMIENTO PROPUESTO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  <td><?php echo nl2br($row['objetivo']);?></td></tr>
  </tbody>
  <thead class="thead-light">
    <tr>
      <th class="text-center" scope="col">BENEFICIOS QUE RAZONABLEMENTE SE PUEDEN ESPERAR DEL TRATAMIENTO O PROCEDIMIENTO PROPUESTO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  <td><?php echo nl2br($row['beneficio']);?></td>
    </tr>
  </tbody>
  <thead class="thead-light">
    <tr>
      <th class="text-center" scope="col">RIESGOS, EFECTOS ADVERSOS Y/O COMPLICACIONES DEL TRATAMIENTO O PROCEDIMIENTO PROPUESTO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  <td><?php echo nl2br($row['riesgo']);?></td>
</tr>
  </tbody>
  </table>
  <table class="table">
  <thead class="thead-light">
    <tr>
      <th class="text-center" colspan="4">ALTERNATIVAS AL TRATAMIENTO O PROCEDIMIENTO PROPUESTO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      
  
  <?php if($row['existe_alternativa'] == "Si"){?>
  <td class="text-left border data" >SI, EXISTEN OTRAS ALTERNATIVAS</td>
  <td class="text-left border data" ><strong><?php echo "X"; ?></strong></td>
  <td class="text-left border data" >NO, LA ÚNICA ALTERNATIVA ES NO TRATAR O NO APLICAR EL PROCEDIMIENTO</td>
  <td class="text-left border data" ><strong></strong></td>
  <?php }else{?>
  <td class="text-left border data" >SI, EXISTEN OTRAS ALTERNATIVAS</td>
  <td class="text-left border data" ><strong></strong></td>
  <td class="text-left border data" >NO, LA ÚNICA ALTERNATIVA ES NO TRATAR O NO APLICAR EL PROCEDIMIENTO</td>
  <td class="text-left border data" ><strong><?php echo "X"; ?></strong></td>
  <?php }?>
 </tr>
  </tbody>
  <thead class="thead-light">
    <tr>
      <th class="text-center" colspan="4">DESCRIBA LAS ALTERNATIVAS AL TRATAMIENTO O PROCEDIMIENTO PROPUESTO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  <td><?php echo nl2br($row['alternativa']);?></td>
 </tr>
  </tbody>
  <thead class="thead-light">
    <tr>
      <th class="text-center" colspan="4">RESPUESTAS A INQUIETUDES MANIFESTADAS POR EL PACIENTE O SU REPRESENTANTE LEGAL</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td class="border" colspan="4">
     <label for="validationCustomNombre">Descripción de las Inquietudes</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control"  name="inquietudes" id="validationCustomNombre" aria-describedby="basic-addon3"></textarea>
</div>
<label for="validationCustomNombre">Respuesta del Medico Tratante</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <textarea class="form-control"  name="respuesta" id="validationCustomNombre" aria-describedby="basic-addon3"></textarea>
</div>
      <td>
 </tr>
 
  </tbody>
  <thead class="thead-light">
    <tr>
      <th class="text-center" colspan="4">DECISIÓN DEL PACIENTE</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  <td colspan="4" ><?php echo nl2br($row['decision']);?></td>
 </tr>
  </tbody>
</table>
<table class="table border">
<thead class="thead-light">
<tr>
      <th class="text-center" colspan="4">Acepta o No Acepta el Procedimiento</th>
    </tr>
</thead>
<tbody>
  <tr>
  <td colspan="4">
  <div class="input-group mb-3">
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="Sí" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault">
    Sí
  </label>
</div>
<div class="form-check ">
  <input class="form-check-input" type="radio" value="No" name="flexRadioDefault" id="flexRadioDefault2">
  <label class="form-check-label" for="flexRadioDefault">
    No
  </label>
</div>
</div>
  </td>
</tr>
<tr >
  <td colspan="4">
  <label for="validationCustomNombre" style="display:none;" id="encabezado_persona_firmante">Persona que Firma el Consentimiento</label>
  <div class="input-group mb-3" style="display:none;" id="persona_firmante">
  <div class="form-check col-md-2">
    <?php $nom = $_SESSION["nombre_repres"]; if($nom == ""){ ?>
  <input class="form-check-input" type="radio" value="Paciente" name="flexRadioFirma" id="flexRadioFirma1" onchange="mostrar2(this.value);">
  <label class="form-check-label" for="flexRadioFirma1">
    Paciente
  </label>
  </div>
  <div class="form-check">
  <?php  }else{ ?>
    <input class="form-check-input" type="radio" value="Representante_Legal" name="flexRadioFirma" id="flexRadioFirma2" onchange="mostrar2(this.value);">
  <label class="form-check-label" for="flexRadioFirma2">
    Representante legal
  </label>
</div>
  <?php } ?>


  
<!--<div class="form-check" style="display:none;">
  <input class="form-check-input" type="radio" value="" name="flexRadioFirma" id="flexRadioFirma3" onchange="mostrar2(this.value);" checked>
  <label class="form-check-label" for="flexRadioFirma3">
  </label>
</div>-->
</div>
  </td>
</tr>
</tbody>
</table>
<div class="container-fluid col-12" style="display:none;" id="firma_paciente">

</div>
<div class="container-fluid col-12" style="display:none;" id="firma_representante">
<table class="table border representante_legal">
<thead class="thead-light">
<tr>
      <th class="text-center" >DATOS DEL REPRESENTANTE LEGAL</th>
    </tr>
</thead>
<tbody>
  <tr>
    <td>
    <label for="validationCustomNombre">Nombre <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $_SESSION["nombre_repres"]; ?>" name="nombre_representante" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
</td>
</tr>
<tr>
    <td>
    <label for="validationCustomNombre">Parentesco <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $_SESSION["parentesco_repres"]; ?>" name="parentesco_representante" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
</td>
</tr>
<tr>
    <td>
    <label for="validationCustomNombre">Numero de Documento de Identidad <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-address-card"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $_SESSION["documento_repres"]; ?>" name="documento_representante" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
</td>
</tr>
</tbody>
</table>
</div>
<div class="container-fluid col-12" style="display:none;" id="revocatoria">
<table class="table border revocatoria">
<thead class="thead-light">
<tr>
      <th class="text-center" >REVOCATORIA DEL CONSENTIMIENTO</th>
    </tr>
</thead>
<tbody>
  <tr>
    <td><?php echo nl2br($row['revocatoria']);?>
</td>
</tr>
<tr>
<th class="bg-primary text-white">
Firma Paciente o Representante Legal
</th>
</tr>
<tr>
  <td>
  <h1>Campo para Firmar</h1>
</td>
</tr>
</tbody>
</table>
</div>
  <div class="col-12 text-center justify-content-center row">

<input class="btn btn-success btn-acepta" type="submit" name="btnAcepta" id="btnAcepta" value="Aceptar" /> 
    
                          </div>
                         
                          
</div>
  </form>
            </div>
</div>      
</div>
</div>
 <?php } }else{?> 
  <div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
              <div class="col-12 d-xl-flex align-items-center justify-content-center" style="width:100%;">
                <div class="alert alert-success alert-dismissible" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Encuesta Pre Sedación</strong> Formato a Diligenciar
  </div>
                </div>
                <div class="col-sm-12 card shadow mb-3">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o"></i> Diligenciar Encuesta</h6>
            </div>
            <div class="col-sm-12 card-body">
            <form id="formulario" method="POST" action="Controlador/Crear_Consentimiento.php?id_cita=<?php echo $id_cita?>&cod_consentimiento=<?php echo $id_consentimiento?>&cod_examen=<?php echo $cod_examen?>"> 
            <label for="validationCustomNombre">Nombre del Paciente <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[1] . " ". $datos[2]; ?>" name="nombre_paciente" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomNombre">Identificación <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[3] ?>" name="documento" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<?php $examendesc = $examen->Consultar_Examen_Por_ID($cod_examen); ?>
<label for="validationCustomNombre">Procedimiento a Realizar <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-medkit"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $examendesc; ?>" name="procedimiento" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomNombre">N° Telefono</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-phone"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="telefono" id="validationCustomNombre" aria-describedby="basic-addon3" onkeypress="return valideKey(event);">
</div>
<label for="validationCustomSelect">Sexo del Paciente <span style="color:red;">(*)</span></label>
<?php $sexx =$datos[18]; if($sexx!=""){ ?>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[18]; ?>" name="selectsexo" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<?php }else{?>
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
<?php }?>
<label for="validationCustomNombre">Edad <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-sort-numeric-asc"></i></span>
  </div>
    <input type="text" class="form-control" value="<?php echo $datos[4]; ?>" name="edad" id="validationCustomNombre" aria-describedby="basic-addon3" readonly="">
</div>
<label for="validationCustomNombre">Peso <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-male"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="peso" id="validationCustomNombre" placeholder="KG" aria-describedby="basic-addon3">
</div>
<label for="validationCustomNombre">Talla <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-male"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="talla" id="validationCustomNombre" aria-describedby="basic-addon3" placeholder="CM">
</div>
<table class="table border">
  <thead class="thead-light">
    <tr>
      <th class="text-center" colspan="2">Lea las siguientes preguntas con atención, marque según corresponda. Especifique las respuestas que fueron marcadas con SI</th>
    </tr>
  </thead>
  <tbody>
    <tr>
<td>¿Tiene alergia conocida a algún medicamento, comida?</td>
<td>

  <div class="input-group mb-3" id="tiene_alergia" >
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_alergia" id="flex_alergia1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_alergia1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_alergia" id="flex_alergia2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_alergia2">
    NO
  </label>
</div>
<div class="cual_alergia" id="cual_alergia" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_alergia">  Cual: </label> <input type="text" class="form-control" value="" name="cual_alergia" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Sufre de Enfermedad cardiaca?</td>
<td>

  <div class="input-group mb-3" id="tiene_cardiaca">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_cardiaca" id="flex_cardiaca1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_cardiaca1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_cardiaca" id="flex_cardiaca2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_cardiaca2">
    NO
  </label>
</div>
<div class="cual_cardiaca" id="cual_cardiaca" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_cardiaca">  Cual: </label> <input type="text" class="form-control" value="" name="cual_cardiaca" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Sufre de enfermedad Pulmonar?</td>
<td>

  <div class="input-group mb-3" id="tiene_pulmonar">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_pulmonar" id="flex_pulmonar1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_pulmonar1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_pulmonar" id="flex_pulmonar2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_pulmonar2">
    NO
  </label>
</div>
<div class="cual_pulmonar" id="cual_pulmonar" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_pulmonar">  Cual: </label> <input type="text" class="form-control" value="" name="cual_pulmonar" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Ha presentado ronquidos al dormir?</td>
<td>

  <div class="input-group mb-3" id="tiene_ronquidos">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_ronquidos" id="flex_ronquidos1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_ronquidos1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_ronquidos" id="flex_ronquidos2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_ronquidos2">
    NO
  </label>
</div>
</div>
</td>
    </tr>
    <tr>
<td>¿Usa CPAP?
<div class="input-group mb-3" id="tiene_cpap">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_cpap" id="flex_cpap1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_cpap1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_cpap" id="flex_cpap2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_cpap2">
    NO
  </label>
</div>
</div>
</td>
<td>¿Usa Oxigeno en la casa?

  <div class="input-group mb-3" id="tiene_oxigeno">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_oxigeno" id="flex_oxigeno1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_oxigeno1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_oxigeno" id="flex_oxigeno2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_oxigeno2">
    NO
  </label>
</div>
</div>
</td>
    </tr>
    <tr>
<td>¿Sufre de enfermedad neurológica/psiquiátrica?</td>
<td>

  <div class="input-group mb-3" id="tiene_psiquiatria">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_psiquiatria" id="flex_psiquiatria1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_psiquiatria1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_psiquiatria" id="flex_psiquiatria2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_psiquiatria2">
    NO
  </label>
</div>
<div class="cual_psiquiatria" id="cual_psiquiatria" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_psiquiatria">  Cual: </label> <input type="text" class="form-control" value="" name="cual_psiquiatria" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Sufre de enfermedad de riñón y/o hígado?</td>
<td>

  <div class="input-group mb-3" id="tiene_higado">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_higado" id="flex_higado1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_higado1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_higado" id="flex_higado2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_higado2">
    NO
  </label>
</div>
<div class="cual_higado" id="cual_higado" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_higado">  Cual: </label> <input type="text" class="form-control" value="" name="cual_higado" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Consume medicamentos que interfieren con la coagulación?</td>
<td>

  <div class="input-group mb-3" id="tiene_coagulacion">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_coagulacion" id="flex_coagulacion1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_coagulacion1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_coagulacion" id="flex_coagulacion2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_coagulacion2">
    NO
  </label>
</div>
<div class="cual_coagulacion" id="cual_coagulacion" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_coagulacion">  Cual: </label> <input type="text" class="form-control" value="" name="cual_coagulacion" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Ha tenido antecedentes de sangrados previos?</td>
<td>
<div class="input-group mb-3" id="tiene_sangrados">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_sangrados" id="flex_sangrados1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_sangrados1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_sangrados" id="flex_sangrados2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_sangrados2">
    NO
  </label>
</div>
</div>
</td>
 </tr>
 <tr>
<td>¿Consume frecuentemente alcohol o drogas?</td>
<td>
<div class="input-group mb-3" id="tiene_alcohol">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_alcohol" id="flex_alcohol1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_alcohol1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_alcohol" id="flex_alcohol2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_alcohol2">
    NO
  </label>
</div>
</div>
</td>
 </tr>
 <tr>
<td>¿Si es mujer cree estar en embarazo?</td>
<td>
<div class="input-group mb-3" id="tiene_embarazo">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_embarazo" id="flex_embarazo1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_embarazo1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_embarazo" id="flex_embarazo2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_embarazo2">
    NO
  </label>
</div>
</div>
</td>
 </tr>
 <tr>
<td>¿Le han realizado cirugías?</td>
<td>
  <div class="input-group mb-3" id="tiene_cirugias">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_cirugias" id="flex_cirugias1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_cirugias1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_cirugias" id="flex_cirugias2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_cirugias2">
    NO
  </label>
</div>
<div class="cual_cirugias" id="cual_cirugias" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_cirugias">  Cual: </label> <input type="text" class="form-control" value="" name="cual_cirugias" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Presento alguna complicación con sedaciones y/o anestesias previas?</td>
<td>
  <div class="input-group mb-3" id="tiene_sedaciones">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_sedaciones" id="flex_sedaciones1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_sedaciones1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_sedaciones" id="flex_sedaciones2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_sedaciones2">
    NO
  </label>
</div>
<div class="cual_sedaciones" id="cual_sedaciones" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_sedaciones">  Cual: </label> <input type="text" class="form-control" value="" name="cual_sedaciones" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Se fatiga con sus actividades diarias?</td>
<td>
  <div class="input-group mb-3" id="tiene_fatiga">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_fatiga" id="flex_fatiga1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_fatiga1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_fatiga" id="flex_fatiga2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_fatiga2">
    NO
  </label>
</div>
</div>
</td>
    </tr>
    <tr>
<td>¿Ha estado hospitalizado en los últimos tres meses?</td>
<td>
  <div class="input-group mb-3" id="tiene_hospitalizacion">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_hospitalizacion" id="flex_hospitalizacion1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_hospitalizacion1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_hospitalizacion" id="flex_hospitalizacion2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_hospitalizacion2">
    NO
  </label>
</div>
<div class="cual_hospitalizacion" id="cual_hospitalizacion" style="visibility:hidden;">
<label for="validationCustomNombre" id="encabezado_tiene_hospitalizacion">  ¿Por qué?: </label> <input type="text" class="form-control" value="" name="cual_hospitalizacion" id="validationCustomNombre" aria-describedby="basic-addon3">
 </div>
</div>
</td>
    </tr>
    <tr>
<td>¿Desea recibir sedación en su procedimiento?</td>
<td>
  <div class="input-group mb-3" id="tiene_procedimiento">
  <div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="SI" name="flex_procedimiento" id="flex_procedimiento1" onchange="mostrar3();">
  <label class="form-check-label" for="flex_procedimiento1">
    SI
  </label>
</div>
<div class="form-check col-md-2">
  <input class="form-check-input" type="radio" value="NO" name="flex_procedimiento" id="flex_procedimiento2" onchange="mostrar3();">
  <label class="form-check-label" for="flex_procedimiento2">
    NO
  </label>
</div>
</div>
</td>
    </tr>
  </tbody>
  <thead class="thead-light">
    <tr>
      <th class="text-center" colspan="2">Liste los medicamentos que usa actualmente:</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td><div class="form-group row">
    <label for="medicamento1" class="col-sm-3 col-form-label">Medicamento:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="medicamento1" name="medicamento1">
    </div></td>
<td>
<div class="form-group row">
    <label for="dosis1" class="col-sm-2 col-form-label">Dosis:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="dosis1" name="dosis1">
    </div>
</div>
</td>
    </tr>
    <tr>
    <td><div class="form-group row">
    <label for="medicamento2" class="col-sm-3 col-form-label">Medicamento:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="medicamento2" name="medicamento2">
    </div></td>
<td>
<div class="form-group row">
    <label for="dosis2" class="col-sm-2 col-form-label">Dosis:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="dosis2" name="dosis2">
    </div>
</div>
</td>
    </tr>
    <tr>
    <td><div class="form-group row">
    <label for="medicamento3" class="col-sm-3 col-form-label">Medicamento:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="medicamento3" name="medicamento3">
    </div></td>
<td>
<div class="form-group row">
    <label for="dosis3" class="col-sm-2 col-form-label">Dosis:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="dosis3" name="dosis3">
    </div>
</div>
</td>
    </tr>
    <tr>
    <td><div class="form-group row">
    <label for="medicamento4" class="col-sm-3 col-form-label">Medicamento:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="medicamento4" name="medicamento4">
    </div></td>
<td>
<div class="form-group row">
    <label for="dosis4" class="col-sm-2 col-form-label">Dosis:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="dosis4" name="dosis4">
    </div>
</div>
</td>
    </tr>
    <tr>
    <td><div class="form-group row">
    <label for="medicamento5" class="col-sm-3 col-form-label">Medicamento:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="medicamento5" name="medicamento5">
    </div></td>
<td>
<div class="form-group row">
    <label for="dosis5" class="col-sm-2 col-form-label">Dosis:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="dosis5" name="dosis5">
    </div>
</div>
</td>
    </tr>
  </tbody>
 </table>
 <div class="col-12 text-center justify-content-center row">

<input class="btn btn-success btn-acepta" type="submit" name="btnConfirmar" id="btnConfirmar" value="Aceptar" /> 
    
                          </div>
 </form>
            </div>
</div>      
</div>
</div>
            <?php }?>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>   
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/formulario_consentimiento.js"></script>
    <?php include "includes/footer.php";?> 
</body>
</html>