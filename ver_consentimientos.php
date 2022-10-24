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
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php include "includes/header.php";?>
<?php 
include_once 'Conexion/Conexion.php';
require 'modelo/Cita.php';
include_once 'modelDao/CitaDao.php';
$citam = new CitaDao(); 
$id_cita = $_GET["id_cita"];
$cod_examen = $_GET["cod_examen"];
$historial = $_GET["historial"];
?>
<div class="container-fluid col-11 mx-auto" style="margin-top: 65px;">
<div class="row">
              
<div class="row col-sm-12 text-left mb-3 d-flex">
              <div class="col-sm-12 text-center mb-3">
                  <?php 
                 $estado_cita = $citam->Consultar_Estado_cita($id_cita);
                 if($estado_cita=="3"){
                   if(@file_get_contents('firma_paciente_temp/firma_paciente_temp.png') || $historial=="true"){
                    
                    }else{?>
                    <div class="row col-sm-12 text-left mb-2 d-flex">
              <div class="col-sm-12 text-secondary"><h4>Solicite la Firma al Paciente/Representante Legal</h4></div>
</div>
   <div id="canva">
   <canvas id='canvas' width="600" height="200" style='border: 1px solid #CCC;'>
       <p>Tu navegador no soporta canvas</p>
   </canvas>
   <firma id="firma"></firma>
   <signature></signature>
 
   <form id='formCanvas' method='post' action="Controlador/control_imagen.php?id_cita=<?php echo $id_cita?>&cod_examen=<?php echo $cod_examen?>&firma=1" ENCTYPE='multipart/form-data'>
     <button class="btn btn-warning" type='button' onclick='LimpiarTrazado()'>Limpiar</button>
       
       <input type='hidden' name='imagen' id='imagen' />
       <br>
       <h2>Seleccione el Usuario que Firma</h2>
       <input type="radio" class="btn-check" name="options" id="option1" value="Paciente" autocomplete="off" onchange="mostrar(this.value);">
<label class="btn btn-primary" for="option1">Paciente</label>

<input type="radio" class="btn-check" name="options" id="option2" value="Representante Legal" autocomplete="off" onchange="mostrar(this.value);">
<label class="btn btn-primary" for="option2">Representante Legal</label>

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
    <input type="text" class="form-control" value="" name="nombre_representante" id="validationCustomNombre" aria-describedby="basic-addon3">
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
    <input type="text" class="form-control" value="" name="parentesco_representante" id="validationCustomNombre" aria-describedby="basic-addon3">
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
    <input type="text" class="form-control" value="" name="documento_representante" id="validationCustomNombre" aria-describedby="basic-addon3">
</div>
</td>
</tr>
</tbody>
</table>
</div><br>
<input class="btn btn-success btn-acepta" type="submit" name="btnAcepta" onclick='GuardarTrazado()' value="Aceptar" /> 
   
                     </form>
     </div>
     
               </div>
   </div>      
   </div>
   </div>
<?php }} ?>
              </div>
       </div>
       <div class="row col-sm-12 text-left mb-3 d-flex">         
              <div class="col-sm-12 text-right" style="display: block;">
                  <!--<a class="btn btn-success" href="crear_consentimiento.php"></a>-->
                  <button type="button" class="btn btn-success" data-toggle="modal" id="select" data-target="#exampleModal">
                  Anexar Consentimiento
</button>
              </div>
       </div>
<div class="col-sm-12 card shadow mb-3">
<div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-address-book-o"></i> Consentimientos informados</h6>
            </div>
            <div class="col-sm-12 card-body">
            <?php 
include_once 'Conexion/Conexion.php';
require 'modelo/Estado.php';
include_once 'modelDao/EstadoDao.php';
require 'modelo/Examen.php';
include_once 'modelDao/ExamenDao.php';
require 'modelo/Consentimiento.php';
include_once 'modelDao/ConsentimientoDao.php';
$estado = new EstadoDao();
$examen = new ExamenDao();
$consentimiento = new ConsentimientoDao();


$conexion = new conexion();
$conexion = $conexion->connect(); 
$consulta = "SELECT * FROM cita_consent where id_cita = $id_cita";

?>
            <table id="minhatabela" class="display responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <br>
                <thead>
                    <tr>
                        <th class="text-center">ID CITA</th>
                        <!--<th class="text-center">OBJETIVO</th>-->
                        <!--<th class="text-center">EXAMEN</th>-->
                        <th class="text-center">CONSENTIMIENTO</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($conexion->query($consulta) as $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo $row['id_cita']; ?></td>
                        <td class="text-center"><?php $cod = $row['cod_consentimiento']; echo $consentimiento->Consultar_Nombre_Consentimiento($cod); ?></td>
                        <?php if($row['id_estado']==6 && $historial == "false"):?>
                        <td class="text-center"><?php $id = $row['id_estado']; echo $estado->Consultar_Estado_Por_ID($id);?><br><div class="progress progress-sm">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div></td> 
                          <td class="text-center"><a class="btn btn-success" title="Diligenciar" href="<?php echo "Controlador/Desplegar_Consentimiento.php?id_cita=" . $row['id_cita'] ."&cod_consentimiento=" . $row['cod_consentimiento'] . "&cod_examen=" . $cod_examen ?>"><span class="fa fa-pencil-square-o" style="color: white;"></span></a></td>                       
                        <?php elseif($row['id_estado']==7):?>
                          <td class="text-center"><?php $id = $row['id_estado']; echo $estado->Consultar_Estado_Por_ID($id);?><br><div class="progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div></td>
                          <td class="text-center"><a class="btn btn-primary" title="Descargar" href="<?php echo "Controlador/Descargar_Consentimiento.php?id_cita=" . $row['id_cita'] ."&cod_consentimiento=" . $row['cod_consentimiento'] . "&cod_examen=" . $cod_examen ?>" target="_blank"><span class="fa fa-download" style="color: white;"></span></a></td>
                          <?php elseif($row['id_estado']==8):?>
                            <td class="text-center"><?php $id = $row['id_estado']; echo $estado->Consultar_Estado_Por_ID($id);?><br><div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div></td>
                          <td class="text-center"><a class="btn btn-primary" title="Descargar" href="<?php echo "Controlador/Descargar_Consentimiento.php?id_cita=" . $row['id_cita'] ."&cod_consentimiento=" . $row['cod_consentimiento'] . "&cod_examen=" . $cod_examen ?>" target="_blank"><span class="fa fa-download" style="color: white;"></span></a></td>
                          <?php elseif($row['id_estado']==6 && $historial == "true"):?>
                            <td class="text-center"><?php $id = $row['id_estado']; echo $estado->Consultar_Estado_Por_ID($id);?><br><div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                          </div></td>
                          <td class="text-center">En Proceso</td>                        
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
  <?php if($historial=="true"){?>
<a class="btn btn-primary" href="historial_citas.php" role="button">Volver</a>
<?php }else {?>
  <a class="btn btn-primary" href="principal.php" role="button">Volver</a>
<?php }?>
                          </div>
                          <!--<div class="col-6 text-right mb-3">
<a class="btn btn-danger" href="" role="button">No Asistió</a>
              </div>-->
                          </div> 
</div>
<form name="f1" id="formElement"  method='post' action="Controlador/Anexar_Consentimiento_Cita.php?id_cita=<?php echo $id_cita?>&cod_examen=<?php echo $cod_examen?>" ENCTYPE='multipart/form-data'>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seleccione el/los Consentimientos a Anexar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
      $consulta = "SELECT con.codigo,con.descripcion FROM consentimiento as con WHERE con.id_estado=1 and con.codigo NOT IN (SELECT cit.cod_consentimiento FROM cita_consent as cit WHERE cit.id_cita=$id_cita)";

?>
            <table id="minhatabela2" class="display responsive table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <br>
                <thead>
                    <tr>
                        <th class="text-center">CONSENTIMIENTO</th>
                        <!--<th class="text-center">OBJETIVO</th>-->
                        <!--<th class="text-center">EXAMEN</th>-->
                        <th class="text-center">ANEXAR</th>
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
        <input class="btn btn-success btn-confirma" type="submit" name="btnConfirma" id="btnConfirma" value="Confirmar" /> 
 
      </div>
    </div>
  </div>
</div>
                    </form>
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
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    --><script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
                "sZeroRecords":    "No se encontraron Consentimientos",
                "sEmptyTable":     "No Existen Consentimientos Anexados a la Cita Medica :(",
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


var table = $('#minhatabela2').DataTable( {
  destroy: true,
  deferRender:    true, 
  autoWidth: false,     
  "search": {
    "regex": true,
    "caseInsensitive": false,
  },language: {
      "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron Consentimientos",
                "sEmptyTable":     "No Hay Consentimientos Disponibles :(",
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

$(document).ready(function() {
    $('#select').click(function() {
        $(":checkbox").prop('checked', false);
    })
});
    </script>
    <script>
      var table = $('#minhatabela2');

      if (tabla.firstChild) {
        
        document.getElementById("btnConfirma").setAttribute("disabled","true");
      }else{
        document.getElementById("btnConfirma").setAttribute("disabled","false");
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
    <?php include "includes/footer.php";?>
    <script type="text/javascript">
    /* Variables de Configuracion */
    var idCanvas='canvas';
    var idForm='formCanvas';
    var inputImagen='imagen';
    var estiloDelCursor='crosshair';
    var colorDelTrazo='#555';
    var colorDeFondo='#fff';
    var grosorDelTrazo=2;

    /* Variables necesarias */
    var contexto=null;
    var valX=0;
    var valY=0;
    var flag=false;
    var imagen=document.getElementById(inputImagen); 
    var anchoCanvas=document.getElementById(idCanvas).offsetWidth;
    var altoCanvas=document.getElementById(idCanvas).offsetHeight;
    var pizarraCanvas=document.getElementById(idCanvas);

    /* Esperamos el evento load */
    window.addEventListener('load',IniciarDibujo,false);

    function IniciarDibujo(){
      /* Creamos la pizarra */
      pizarraCanvas.style.cursor=estiloDelCursor;
      contexto=pizarraCanvas.getContext('2d');
      contexto.fillStyle=colorDeFondo;
      contexto.fillRect(0,0,anchoCanvas,altoCanvas);
      contexto.strokeStyle=colorDelTrazo;
      contexto.lineWidth=grosorDelTrazo;
      contexto.lineJoin='round';
      contexto.lineCap='round';
      /* Capturamos los diferentes eventos */
      pizarraCanvas.addEventListener('mousedown',MouseDown,false);// Click pc
      pizarraCanvas.addEventListener('mouseup',MouseUp,false);// fin click pc
      pizarraCanvas.addEventListener('mousemove',MouseMove,false);// arrastrar pc

      pizarraCanvas.addEventListener('touchstart',TouchStart,false);// tocar pantalla tactil
      pizarraCanvas.addEventListener('touchmove',TouchMove,false);// arrastras pantalla tactil
      pizarraCanvas.addEventListener('touchend',TouchEnd,false);// fin tocar pantalla dentro de la pizarra
      pizarraCanvas.addEventListener('touchleave',TouchEnd,false);// fin tocar pantalla fuera de la pizarra
    }

    function MouseDown(e){
      flag=true;
      contexto.beginPath();
      valX=e.pageX-posicionX(pizarraCanvas); valY=e.pageY-posicionY(pizarraCanvas);
      contexto.moveTo(valX,valY);
    }

    function MouseUp(e){
      contexto.closePath();
      flag=false;
    }

    function MouseMove(e){
      if(flag){
        contexto.beginPath();
        contexto.moveTo(valX,valY);
        valX=e.pageX-posicionX(pizarraCanvas); valY=e.pageY-posicionY(pizarraCanvas);
        contexto.lineTo(valX,valY);
        contexto.closePath();
        contexto.stroke();
      }
    }

    function TouchMove(e){
      e.preventDefault();
      if (e.targetTouches.length == 1) { 
        var touch = e.targetTouches[0]; 
        MouseMove(touch);
      }
    }

    function TouchStart(e){
      if (e.targetTouches.length == 1) { 
        var touch = e.targetTouches[0]; 
        MouseDown(touch);
      }
    }

    function TouchEnd(e){
      if (e.targetTouches.length == 1) { 
        var touch = e.targetTouches[0]; 
        MouseUp(touch);
      }
    }

    function posicionY(obj) {
      var valor = obj.offsetTop;
      if (obj.offsetParent) valor += posicionY(obj.offsetParent);
      return valor;
    }

    function posicionX(obj) {
      var valor = obj.offsetLeft;
      if (obj.offsetParent) valor += posicionX(obj.offsetParent);
      return valor;
    }

    /* Limpiar pizarra */
    function LimpiarTrazado(){
      contexto=document.getElementById(idCanvas).getContext('2d');
      contexto.fillStyle=colorDeFondo;
      contexto.fillRect(0,0,anchoCanvas,altoCanvas);
    }

    /* Enviar el trazado */
    function GuardarTrazado(){
      imagen.value=document.getElementById(idCanvas).toDataURL('image/png');
      document.forms[idForm].submit();
    }
</script>
<script>
$(document).ready(function() {
          
          $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
      });

      function mostrar(dato) {
        
  if (dato == "Representante Legal") {
    document.getElementById("firma_representante").style.display = "block";
  }else if(dato == "Paciente"){
    document.getElementById("firma_representante").style.display = "none";
  }
}
  </script>
</body>
</html>

