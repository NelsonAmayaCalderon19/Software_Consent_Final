<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>

<?php 
      include_once '../../Conexion/Conexion.php';
      require '../../modelo/Usuario.php';
      include_once '../../modelDao/UsuarioDao.php';
      require '../../modelo/Profesional.php';
      include_once '../../modelDao/ProfesionalDao.php';
      include_once '../../javaScript/script_sweet.js';

      $profesional = new ProfesionalDao();
      $usuario = new UsuarioDao();
      $documento = $_POST['documento'];
      $nombre = $_POST['nombre_completo'];
      $id_cargo = $_POST["selectcargo"];

      $profesional ->Actualizar_Profesional($documento,$nombre,$id_cargo);
      if($id_cargo==3 || $id_cargo==4){
        $clave = $_POST["password"];
        $usuario->Actualizar_Clave_Usuario($documento,$clave);
    }
      if($profesional){
          
        header("Refresh: 1; URL=../personal.php");

        echo '<script>
        Swal.fire({
         icon: "success",
         title: "Proceso Exitoso",
         text: "Datos del Profesional Actualizados",
         showConfirmButton:false,
         });
        </script>';
            }else{
            echo "No se Inserto";
            }

?>