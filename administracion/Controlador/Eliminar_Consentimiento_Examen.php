<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
  <?php 
      include_once '../../Conexion/Conexion.php';
      //require '../../modelo/Usuario.php';
      require '../../modelo/Consentimiento.php';
      include_once '../../modeldao/ConsentimientoDao.php';

      $codigo = $_GET['cod_examen'];
      $cod_consentimiento = $_GET['cod_consentimiento'];
      
      $examen = new ConsentimientoDao();
      $examen->Eliminar_Examen_Consentimiento($codigo,$cod_consentimiento);
      header("location:../informacion_examen.php?cod_examen=" .$codigo);
      ?>