<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
  <?php 
      include_once '../../Conexion/Conexion.php';
      require '../../modelo/Profesional.php';
      include_once '../../modelDao/ProfesionalDao.php';

      $documento = $_GET['documento'];
      $id_estado = $_GET['id_estado'];
      $estado;
      if($id_estado==1){
        $estado=2;
      }else{
        $estado=1;
      }
      $profesional = new ProfesionalDao();
      $profesional->InActivar_Profesional($documento,$estado);
      header("location:../personal.php");
      ?>