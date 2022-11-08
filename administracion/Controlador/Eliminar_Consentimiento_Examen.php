<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
  <?php 
      include_once '../../Conexion/Conexion.php';
      require '../../modelo/Consentimiento.php';
      include_once '../../modelDao/ConsentimientoDao.php';
      include_once '../../javaScript/script_sweet.js';

      $codigo = $_GET['cod_examen'];
      $cod_consentimiento = $_GET['cod_consentimiento'];      
      $examen = new ConsentimientoDao();
      header("Refresh: 1; URL=../informacion_examen.php?cod_examen=" .$codigo);

        echo '<script>
        Swal.fire({
         icon: "success",
         title: "Proceso Exitoso",
         text: "Consentimiento Eliminado del Examen",
         showConfirmButton:false,
         });
        </script>';
      $examen->Eliminar_Examen_Consentimiento($codigo,$cod_consentimiento);
      ?>