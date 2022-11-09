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
      $examen = new ExamenDao();

      if(filter_input(INPUT_POST, 'btnAcepta')){
        $codigo = $_GET['cod_examen'];
        if(!empty($_POST['check_list'])){
          foreach($_POST['check_list'] as $selected){
          $examen->crear_Examen_Consentimiento($codigo,$selected); 
          }  
        }

        if($examen){
                   
  header("Refresh: 1; URL=../informacion_examen.php?cod_examen=". $codigo ."");

  echo '<script>
  Swal.fire({
   icon: "success",
   title: "Proceso Exitoso",
   text: "Se Anexó el Consentimiento al Examen Satisfactoriamente",
   showConfirmButton:false,
   });
  </script>';
      }else{
      echo "No se Inserto";
      } 
      }

      ?>