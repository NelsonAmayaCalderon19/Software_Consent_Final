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
      
      $profesional = new ProfesionalDao();

      $documento = $_POST['documento'];
      $nombre = $_POST['nombre_completo'];

      $id_cargo = $_POST["radiocargo"];
    $firma_nombre=$_FILES['firma']['name'];
    $firma_tipo = $_FILES['firma']['type'];
    $firma_temp = $_FILES['firma']['tmp_name'];
    $directorio = '../../FirmasProfesionales/';
    $subir_archivo = $directorio.basename($_FILES['firma']['name']);
    move_uploaded_file($_FILES['firma']['tmp_name'], $subir_archivo);

      $profesional ->Registrar_Profesional($documento,$nombre,$firma_nombre,$id_cargo,1);
if($id_cargo==3 || $id_cargo==4){
    $clave = $_POST["password"];
    $profesional->Crear_Usuario($documento,$clave);
}
      if($profesional){
          
        echo '<script>
                          
             window.location = "../personal.php";
           
        </script>';
            }else{
            echo "No se Inserto";
            }

      ?>