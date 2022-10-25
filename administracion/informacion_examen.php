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
<div class="container-fluid col-11 mx-auto" style="margin-top: 65px;">
<div class="row">
<div class="row col-sm-12 text-left mb-3 d-flex">
<div class="col-sm-12 text-right mb-3">
                  <a class="btn btn-primary" href="anexar_consentimiento.php?cod_examen=<?php echo $_GET['cod_examen']; ?>">Anexar Consentimiento</a>
              </div>
<div class="col-sm-12 card shadow mb-3">
<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-address-book-o"></i> Consentimientos Informados Requeridos</h6>
            </div>
            <div class="col-sm-12 card-body">
            <?php 
include_once '../Conexion/Conexion.php';
require '../modelo/Estado.php';
include_once '../modelDao/EstadoDao.php';
$cod_examen = $_GET['cod_examen'];
$id_estado = new EstadoDao();
$conexion = new conexion();
$conexion = $conexion->connect(); 
$consulta = "SELECT SUBSTRING(ruta_archivo,1,25) ruta_archivo,codigo,descripcion,id_estado,conexam.cod_examen FROM consentimiento as con, consent_examen as conexam where con.codigo=conexam.cod_consentimiento and conexam.cod_examen = $cod_examen";
?>
<table id="minhatabela" class="display responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <br>
                <thead>
                    <tr>
                        <th class="text-center">CODIGO</th>
                        <th class="text-center">DESCRIPCION</th>
                        <th class="text-center">RUTA_ARCHIVO</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">ACCION</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($conexion->query($consulta) as $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo $row['codigo']; ?></td>
                        <td class="text-center"><?php echo $row['descripcion']; ?></td>
                        <td class="text-center"><?php echo $row['ruta_archivo']."..."; ?></td>
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
<script type="text/javascript" language="javascript" >
$(document).ready(function() {
  $("#Date_search").val("");
});

var table = $('#minhatabela').DataTable( {
  destroy: true,
  deferRender:    true, 
  autoWidth: false,     
  "search": {
    "regex": true,
    "caseInsensitive": false,
  },language: {
      "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron Proyectos",
                "sEmptyTable":     "Ningún dato disponible en esta tabla :(",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                },              
},});
    </script>
</body>
</html>
