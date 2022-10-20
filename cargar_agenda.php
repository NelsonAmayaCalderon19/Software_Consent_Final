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
    <link rel="stylesheet" type="text/css" href="css/cargar_agenda_cita.css">
	<title>Subir Agenda</title>
    <?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
    </head>
    <body>
    <?php include "includes/header.php";?>
    <div class="container d-flex justify-content-center mt-100">
    <div class="row">
        <div class="col-md-12">
        <h2>Subir Agenda de Citas</h2> 
        <form method="post" action="Controlador/Subir_Archivo.php" enctype="multipart/form-data">   
<div class="file-drop-area">
<i class="fa fa-cloud-upload" aria-hidden="true" id="icono_upload" style="font-size: 5em; 
    color: #007bff;"></i>
  <!--<span class="choose-file-button">Elige el Archivo</span>-->
  <span class="file-message"> Choose a File or Drap it Here</span>
 <input class="file-input" type="file" name="archivo" multiple>
</div>  
<input class="btn btn-primary btn-cargar" type="submit" name="btnCargar" value="Guardar" />
</form>
        </div>   
    </div>    
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
     <script src="js/cargar_agenda.js"></script>
    <?php include "includes/footer.php";?>
    </body>
</html>


