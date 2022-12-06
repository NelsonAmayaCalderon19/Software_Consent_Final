<!DOCTYPE html>
<html lang="en">
<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="images/pestania.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Nelson Eduardo Amaya Calderón">
    
    <title>Consent_Gastro</title>
    <?php
  if (!isset($_SESSION["usuario"])){
    header("location:index.php");
  }
  ?>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

</head>
<body>
<div class="container-fluid col-11 mx-auto" style="margin-top: 65px;">
<div class="row">
              <div class="row col-sm-12 text-left mb-3 d-flex">
              <?php 
include_once 'Conexion/Conexion.php';
require 'modelo/Cita.php';
include_once 'modelDao/CitaDao.php';
$conexion = new conexion();
$conexion = $conexion->connect(); 
$cita = new CitaDao();
$consulta = $cita->listar_citas_Pendientes();
date_default_timezone_set("America/Bogota");
?>
              <div class="col-sm-10 text-secondary"><h4>Agenda del Dia: <?php $fechaActual = date('d-m-Y'); echo $fechaActual?> -> Citas Pendientes: <?php echo $consulta['cantidad_total'];?></h4></div>
              <div class="col-sm-2 text-right">
                  <a class="btn btn-primary" href="crear_cita.php">Crear Cita</a>
              </div> 
            </div>

<div class="col-sm-12 card shadow mb-3">
<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-address-book-o"></i> Citas Pacientes</h6>
            </div>
            <div class="col-sm-12 card-body">
            <?php 
include_once 'Conexion/Conexion.php';
require 'modelo/Estado.php';
include_once 'modelDao/EstadoDao.php';
require 'modelo/Examen.php';
include_once 'modelDao/ExamenDao.php';
$estado = new EstadoDao();
$examen = new ExamenDao();
$conexion = new conexion();
$conexion = $conexion->connect(); 
$consulta = $cita->listar();

?>
            <table id="minhatabela" class="display responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <br>
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">NOMBRE PACIENTE</th>
                        <th class="text-center">APELLIDO PACIENTE</th>
                        <th class="text-center">DOCUMENTO</th>
                        <th class="text-center">EXAMEN</th>
                        <th class="text-center">HORA</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($conexion->query($consulta) as $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo $row['id_cita']; ?></td>
                        <td class="text-center"><?php echo $row['nombre_paciente']; ?></td>
                        <td class="text-center"><?php echo $row['apellido_paciente']; ?></td>
                        <td class="text-center"><?php echo $row['documento']; ?></td>
                        <td class="text-center"><?php $cod = $row['cod_examen']; echo $examen->Consultar_Examen_Por_ID($cod); ?></td>
                          <td class="text-center"><?php echo date( "g:i A", strtotime( $row['hora'] ) ); ?></td>
                        <?php if($row['id_estado']==3):?>
                        <td class="text-center"><?php $id = $row['id_estado']; echo $estado->Consultar_Estado_Por_ID($id);?><br><div class="progress progress-sm">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div></td>
                          <td class="text-center"><a class="btn btn-success" title="Asistió" href="<?php echo "ver_consentimientos.php?id_cita=" . $row['id_cita'] ."&cod_examen=" . $row['cod_examen']. "&historial=false". "&solicitar=false" ?>"><span class="fa fa-check" style="color: white;"></span></a>
                        <a class="btn btn-danger" title="No Asistió" href="javascript:;" onclick="aviso('Controlador/Cita_No_Asistida.php?id_cita= <?php echo $row['id_cita'] ?>'); return false;"><span class="fa fa-close" style="color: white;"></span></a></td>
                        <?php elseif($row['id_estado']==4):?>
                          <td class="text-center"><?php $id = $row['id_estado']; echo $estado->Consultar_Estado_Por_ID($id);?><br><div class="progress progress-sm">
                          <?php if($cita->Validar_Estado_Cita_Sin_Pendientes($row['id_cita'])=="0"){?>
                          <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div><?php }else{?> 
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="50"></div>
                          </div>
                            <?php }?></td>
                          <td class="text-center"><a class="btn btn-primary" title="Ver Detalles" href="<?php echo "ver_consentimientos.php?id_cita=" . $row['id_cita'] ."&cod_examen=" . $row['cod_examen']. "&historial=false". "&solicitar=false" ?>"><span class="fa fa-eye" style="color: white;" disabled></span></a>
                       </td>
                          <?php else:?>
                            <td class="text-center"><?php $id = $row['id_estado']; echo $estado->Consultar_Estado_Por_ID($id);?><br><div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div></td>
                          <td class="text-center"></td>
                          <?php endif;?>
                        
                    </tr>  
                    <?php } ?>   
                </tbody>
            </table> 
</div>
</div>
</div>
</div>
  <script src="vendor2/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor2/jquery-easing/jquery.easing.min.js"></script>
   <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> 
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src='javaScript/agenda_day.js'></script>
</body>
</html>

