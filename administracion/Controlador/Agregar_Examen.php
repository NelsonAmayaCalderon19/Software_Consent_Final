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
        $descripcion = $_POST['nombre_examen'];
        $cod_examen = $examen->Crear_Examen($descripcion);
        if(!empty($_POST['check_list'])){
          foreach($_POST['check_list'] as $selected){
          $examen->crear_Examen_Consentimiento($cod_examen,$selected); 
          }  
        }
        if($examen){           
        header("Refresh: 1; URL=../examenes.php");

        echo '<script>
        Swal.fire({
         icon: "success",
         title: "Proceso Exitoso",
         text: "examen Registrado Satisfactoriamente",
         showConfirmButton:false,
         });
        </script>';
            }else{
            echo "No se Inserto";
            }
            /*header("location:../examenes.php");
              }else{
              echo "No se Inserto";
              }*/
      }

      ?>