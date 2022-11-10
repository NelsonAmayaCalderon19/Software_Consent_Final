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
        if($clave!=""){
        $usuario->Actualizar_Clave_Usuario($documento,$clave);
        }
    }
    if($id_cargo==1 || $id_cargo==2){
      $validar_firma = $_FILES['firma']['name'];
      if(!empty($validar_firma)){
      $firma_nombre= $_FILES['firma']['name'];
    $firma_tipo = $_FILES['firma']['type'];
    $firma_temp = $_FILES['firma']['tmp_name'];
    $directorio = '../../FirmasProfesionales/';
    $subir_archivo = $directorio.basename($_FILES['firma']['name']);
    move_uploaded_file($_FILES['firma']['tmp_name'], $subir_archivo);
    $profesional ->Actualizar_firma_Profesional($documento,$firma_nombre);
      }
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