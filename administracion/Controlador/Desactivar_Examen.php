<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
  <?php 
      include_once '../../Conexion/Conexion.php';
      require '../../modelo/Examen.php';
      include_once '../../modelDao/ExamenDao.php';
      include_once '../../javaScript/script_sweet.js';

      $codigo = $_GET['cod_examen'];
      $id_estado = $_GET['id_estado'];
      $estado;
      if($id_estado==1){
        $estado=2;
      }else{
        $estado=1;
      }
      $examen = new ExamenDao();
      $examen->InActivar_Examen($codigo,$estado);
if($estado==2){
      header("Refresh: 1; URL=../examenes.php");

  echo '<script>
  Swal.fire({
   icon: "success",
   title: "Proceso Exitoso",
   text: "El Examen fue Deshabilitado",
   showConfirmButton:false,
   });
  </script>';
  }else{
  header("Refresh: 1; URL=../examenes.php");

  echo '<script>
  Swal.fire({
   icon: "success",
   title: "Proceso Exitoso",
   text: "El Examen fue Habilitado",
   showConfirmButton:false,
   });
  </script>';
  }
      
      ?>