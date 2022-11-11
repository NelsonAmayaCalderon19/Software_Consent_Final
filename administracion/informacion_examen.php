<!DOCTYPE html>
<html lang="en">
<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="../images/pestania.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Nelson Eduardo Amaya Calderón">

    <title>Información Examen</title>
    <?php
session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

</head>
<body>
<?php include "includes/header.php";?>
<?php
include_once '../Conexion/Conexion.php';
require '../modelo/Estado.php';
include_once '../modelDao/EstadoDao.php';
require '../modelo/Examen.php';
include_once '../modelDao/ExamenDao.php';
$cod_examen = $_GET['cod_examen'];
$id_estado = new EstadoDao();
$examen = new ExamenDao();
$conexion = new conexion();
$conexion = $conexion->connect(); 
$nombre_Examen = $examen->Consultar_Examen_Por_ID($cod_examen);
?>
<div class="container-fluid col-11 mx-auto" style="margin-top: 65px;">
<div class="row">
<div class="row col-sm-12 text-left mb-3 d-flex">
<div class="row col-sm-6 text-left mb-3">

            <h3 class="text-muted"><?php echo $nombre_Examen;?></h3>
                </div>
<div class="col-sm-6 text-right mb-3">

            <button type="button" class="btn btn-primary" data-toggle="modal" id="select" data-target="#exampleModal">
Anexar Consentimiento
</button>
                </div>
<div class="col-sm-12 card shadow mb-3">
<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-address-book-o"></i> Consentimientos Informados Requeridos</h6>
            </div>
            <div class="col-sm-12 card-body">
            <?php 
$consulta = "SELECT SUBSTRING(ruta_archivo,1,25) ruta_archivo,codigo,descripcion,id_estado,conexam.cod_examen FROM consentimiento as con, consent_examen as conexam where con.codigo=conexam.cod_consentimiento and conexam.cod_examen = $cod_examen";
?>
<table id="minhatabela" class="display responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <br>
                <thead>
                    <tr>
                        <th class="text-center">CODIGO</th>
                        <th class="text-center">DESCRIPCION</th>
                       <!-- <th class="text-center">RUTA_ARCHIVO</th>-->
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">ACCION</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($conexion->query($consulta) as $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo $row['codigo']; ?></td>
                        <td class="text-center"><?php echo $row['descripcion']; ?></td>
                       <!-- <td class="text-center"></td>-->
                        <?php $estado = $id_estado->Consultar_Estado_Por_ID($row['id_estado']); ?>
                        <?php if($row['id_estado'] == 1):?>
                          <td class="text-center"><?php echo $estado;?><br><div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div></td>
                        <td class="text-center">
                        <a class="btn btn-primary" title="Descargar" href="<?php echo "Controlador/Descargar_Consentimiento.php?cod_consentimiento=" . $row['codigo'] ?>" target="_blank"><span class="fa fa-download" style="color: white;"></span></a>
                        <a class="btn btn-danger" title="Eliminar" href="<?php echo "Controlador/Eliminar_Consentimiento_Examen.php?cod_consentimiento=" . $row['codigo'] ."&cod_examen=" . $row['cod_examen'] ?>"><span class="fa fa-close" style="color: white;"></span></a>                     
                      </td>
                      <?php elseif($row['id_estado'] == 2):?>
                        <td class="text-center"><?php echo $estado;?><br><div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div></td>
                        <td class="text-center">
                        <a class="btn btn-primary" title="Descargar" href="<?php echo "Controlador/Descargar_Consentimiento.php?cod_consentimiento=" . $row['codigo'] ?>" target="_blank"><span class="fa fa-download" style="color: white;"></span></a>
                        <a class="btn btn-success" title="Eliminar" href="<?php echo "Controlador/Eliminar_Consentimiento_Examen.php?cod_consentimiento=" . $row['codigo'] ."&cod_examen=" . $row['cod_examen'] ?>"><span class="fa fa-close" style="color: white;"></span></a>                     
                      </td>
                        <?php endif;?>
                    </tr>  
                    <?php } ?>   
                </tbody>
            </table>
 
</div>
</div>
</div>
<div class="col-12 text-left row">
<div class="col-6 text-left mb-3">

  <a class="btn btn-warning" href="examenes.php" role="button">Volver</a>

                          </div>
                          </div> 
</div>
</div>
<form name="f2" id="formElement2"  method='post' action="Controlador/Anexar_Consentimiento_Examen.php?cod_examen=<?php echo $_GET['cod_examen'];?>" ENCTYPE='multipart/form-data'>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">  
      <div class="modal-header">    
<h4>Seleccione los consentimientos a Anexar al Examen</h4>       
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> 
            
      </div>
      <div class="modal-body">
      <!--<p>
            <a class="btn btn-success" id="marcarTodo">Marcar todos los checkbox</a> |
            <a class="btn btn-warning" id="desmarcarTodo">Desmarcar todos los checkbox</a>
        </p>  -->
      <p id="variable"></p>
        <?php
      $consulta = "SELECT con.codigo,con.descripcion FROM consentimiento AS con WHERE NOT exists (SELECT * FROM consent_examen AS conexam WHERE con.codigo=conexam.cod_consentimiento AND conexam.cod_examen =".$_GET['cod_examen'].")";

?>
            <table id="minhatabela3" class="display responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <br>
                <thead>
                    <tr>
                        <th class="text-center">CONSENTIMIENTO</th>
                        <th class="text-center">ASIGNAR</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($conexion->query($consulta) as $row) { ?>
                    <tr>
                    <td class="text-center"><?php echo $row['descripcion']; ?></td>
                        <td class="text-center"><div class="form-check">
  <input class="form-check-input" name="check_list[]" type="checkbox" value="<?php echo $row['codigo']; ?>" id="flexCheckDefault" onclick="disableSending(this);">
  <label class="form-check-label" for="flexCheckDefault">
  </label>
</div></td>                      
                    </tr>  
                    <?php } ?>   
                </tbody>
            </table> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input class="btn btn-success btn-acepta2" type="submit" name="btnAcepta" id="btnAcepta" value="Confirmar" disabled /> 
 
      </div>
    </div>
  </div>
</div>
                    </form>     
<script src="vendor2/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor2/jquery-easing/jquery.easing.min.js"></script>
   <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>   
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> 
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <?php include "includes/footer.php";?>
  <script src="js/informacion_examen.js"></script>
</body>
</html>
