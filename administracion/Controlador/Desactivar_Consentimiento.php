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

      $codigo = $_GET['cod_consentimiento'];
      $id_estado = $_GET['id_estado'];
      $estado;
      if($id_estado==1){
        $estado=2;
      }else{
        $estado=1;
      }
      $consentimiento = new ConsentimientoDao();
      $consentimiento->InActivar_Consentimiento($codigo,$estado);
      header("location:../panel_admin.php");
      ?>