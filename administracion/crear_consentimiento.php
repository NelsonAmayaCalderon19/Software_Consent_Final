<!DOCTYPE html>
<html lang="en">
<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"  href="../images/pestania.png">
    <!-- Bootstrap CSS -->
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

	<title>Nuevo Consentimiento</title>
    <?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
            <?php 
include_once '../Conexion/Conexion.php';
$conexion = new conexion();
$conexion = $conexion->connect(); 
$consul_examen = "SELECT * FROM examen where id_estado=1";
?>
    </head>
    <body>
     
    <?php include "includes/header.php";?>
    <div class="container-fluid col-11 mx-auto" style="margin-top: 60px;">
          <div class="row">
<div class="col-sm-12 text-center mb-3">
            <h3 class="text-muted">CREACIÓN DE CONSENTIMIENTO INFORMADO</h3>
                </div>
          <div class="col-sm-12 card shadow mb-3">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-square-o"></i> Ingresar Información</h6>
            </div>
            <div class="col-sm-12 card-body">
            <form method="post" action="Controlador/Crear_Consentimiento.php">
            <label for="validationCustomNombre">Codigo del Consentimiento <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-id-card-o"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="codigo_consentimiento" id="validationCustomNombre" aria-describedby="basic-addon3" required>
</div>
<label for="validationCustomSelect">Seleccione el/los Examanes Relacionados con el Nuevo Consentimiento <span style="color:red;">(*)</span></label>
     <div class="col-sm-12 card-body">
  <?php
      $consulta = "SELECT * FROM examen where id_estado=1";
?>
  <table id="minhatabela3" class="display responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <br>
                <thead>
                    <tr>
                        <th class="text-center">EXAMEN</th>
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
            <label for="validationCustomNombre">Nombre del Procedimiento <span style="color:red;">(*)</span></label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-medkit"></i></span>
  </div>
    <input type="text" class="form-control" value="" name="nombre_procedimiento" id="validationCustomNombre" aria-describedby="basic-addon3" required>
</div>
<label for="validationCustomNombre">Descripción del Procedimiento</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-indent"></i></span>
  </div>
    <textarea class="form-control"  name="descripcion" id="validationCustomNombre" style="height: 7em;" aria-describedby="basic-addon3"></textarea>
</div>
<label for="validationCustomNombre">Objetivo</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-bullseye"></i></span>
  </div>
    <textarea class="form-control"  name="objetivo" id="validationCustomNombre" style="height: 7em;" style="height: 10em;" aria-describedby="basic-addon3"></textarea>
</div>
<label for="validationCustomNombre">Beneficios</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-heart"></i></span>
  </div>
    <textarea class="form-control"  name="beneficios" id="validationCustomNombre" style="height: 7em;" aria-describedby="basic-addon3"></textarea>
</div>
<label for="validationCustomNombre">Riesgos</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-exclamation-triangle"></i></span>
  </div>
    <textarea class="form-control"  name="riesgos" id="validationCustomNombre" style="height: 10em;" aria-describedby="basic-addon3"></textarea>
</div>
<label for="validationCustomSelect">Existen otras Alternativas <span style="color:red;">(*)</span></label>

     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-filter"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectalternativas" aria-describedby="inputGroupPrepend" required>
         
                        <option value="Si">Si</option>
                        <option value="No">No</option>
  </select>
</div>
<label for="validationCustomNombre">Alternativas</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-list-ol"></i></span>
  </div>
    <textarea class="form-control"  name="alternativas" style="height: 10em;" id="validationCustomNombre" aria-describedby="basic-addon3"></textarea>
</div>
<label for="validationCustomNombre">Decisión</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-book"></i></span>
  </div>
    <textarea class="form-control" style="height: 10em;"  name="decision" id="validationCustomNombre" aria-describedby="basic-addon3"></textarea>
</div>
<label for="validationCustomNombre">Revocatoria</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon3"><i class="fa fa-window-close"></i></span>
  </div>
    <textarea class="form-control"  name="revocatoria" id="validationCustomNombre" style="height: 10em;" aria-describedby="basic-addon3"></textarea>
</div>
<label for="validationCustomSelect">Profesional que Firma <span style="color:red;">(*)</span></label>

     <div class="input-group mb-3">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-user-md"></i></label>
  </div>
         <select class="custom-select" id="validationCustomSelect" name="selectfirmante" aria-describedby="inputGroupPrepend" required>
         
                        <option value="MEDICO">Médico</option>
                        <option value="PERSONAL DE ENFERMERIA">Enfermero/a</option>
  </select>
</div>
<div class="col-12 text-center justify-content-center row">
<a class="btn btn-warning mr-3" href="panel_admin.php" style="color: white;">Cancelar</a>
<input class="btn btn-success btn-acepta" type="submit" name="btnAcepta" value="Aceptar" /> 
    
                          </div>
                         
                          
</div>
  </form>
            </div>
</div>      
</div>
</div>
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
  <script src="js/crear_consentimiento.js"></script>
<?php include "includes/footer.php";?>
</body>
</html>