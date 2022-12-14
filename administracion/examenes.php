<!DOCTYPE html>
<html lang="en">
<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="../images/pestania.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Nelson Eduardo Amaya Calderón">

    <title>Examenes Gastroquirurgica</title>
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
<div class="container-fluid col-11 mx-auto" style="margin-top: 65px;">
<div class="row">
<div class="row col-sm-12 text-left mb-3 d-flex">
<div class="col-sm-12 text-right mb-3">
                  <button type="button" class="btn btn-primary" data-toggle="modal" id="select" data-target="#exampleModal">
                  Añadir Examen
</button>
              </div>
            <div class="col-sm-12 card shadow mb-3">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-address-book-o"></i> Examenes Gastroquirurgica</h6>
            </div>
            <div class="col-sm-12 card-body">
            <?php 
include_once '../Conexion/Conexion.php';
$conexion = new conexion();
$conexion = $conexion->connect(); 
$consulta = "SELECT * FROM examen";
?>
<table id="minhatabela" class="display responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <br>
                <thead>
                    <tr>
                        <th class="text-center">CODIGO</th>
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">OPCIONES</th>
                       
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($conexion->query($consulta) as $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo $row['codigo']; ?></td>
                        <td class="text-center"><?php echo $row['descripcion']; ?></td>
                    
                        <?php if($row['id_estado'] == 1):?>                       
                        <td class="text-center">
                        <a class="btn btn-warning" title="Ver Información" href="<?php echo "informacion_examen.php?cod_examen=" . $row['codigo'] ?>"><span class="fa fa-eye" style="color: white;"></span></a>
                        <a class="btn btn-danger" title="Deshabilitar" href="<?php echo "Controlador/Desactivar_Examen.php?cod_examen=" . $row['codigo'] ."&id_estado=" . $row['id_estado'] ?>"><span class="fa fa-minus-circle" style="color: white;"></span></a>                     
                      </td>
                      <?php elseif($row['id_estado'] == 2):?>                        
                        <td class="text-center">
                        <a class="btn btn-warning" title="Ver Información" href="<?php echo "informacion_examen.php?cod_examen=" . $row['codigo'] ?>"><span class="fa fa-eye" style="color: white;"></span></a>
                        <a class="btn btn-success" title="Habilitar" href="<?php echo "Controlador/Desactivar_Examen.php?cod_examen=" . $row['codigo'] ."&id_estado=" . $row['id_estado'] ?>"><span class="fa fa-check-circle" style="color: white;"></span></a>                     
                      </td>
                        <?php endif;?>
                    </tr>  
                    <?php } ?>   
                </tbody>
            </table>

</div>
</div>
</div>
</div>
                      </div>
                      <form name="f2" id="formElement2"  method='post' action="Controlador/Agregar_Examen.php" ENCTYPE='multipart/form-data'>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">  
    <div class="row justify-content-center">
          
          <div class="col-sm-10 card-body">
    <label for="validationCustomNombre">Nombre del Examen <span style="color:red;">(*)</span></label>
<div class="input-group mb-2">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-user"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="nombre_examen" id="validationCustomNombre" aria-describedby="basic-addon3" required>
</div>
</div>
</div>
      <div class="modal-header">
      
<h6>Seleccione los consentimientos Relacionados con el Examen <span style="color:red;">(*)</span></h6>
        
          
      </div>
      <div class="modal-body">
      <p id="variable"></p>
        <?php
      $consulta = "SELECT * FROM consentimiento where id_estado=1";

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
  <input class="form-check-input" name="check_list[]" type="checkbox" value="<?php echo $row['codigo']; ?>" id="flexCheckDefault">
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
        <input class="btn btn-success btn-acepta2" type="submit" name="btnAcepta" id="btnAcepta" value="Confirmar" /> 
 
      </div>
    </div>
  </div>
</div>
                    </form>     
<!--<script src="vendor2/jquery/jquery.min.js"></script>-->
  <script src="vendor2/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor2/jquery-easing/jquery.easing.min.js"></script>
   <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 <!-- <script src="vendor/chart.js/Chart.min.js"></script>-->
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> 
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <?php include "includes/footer.php";?>
  <script src="js/examen.js"></script>
</body>
</html>