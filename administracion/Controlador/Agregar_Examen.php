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
      $examen = new ExamenDao();

      if(filter_input(INPUT_POST, 'btnAcepta')){
        $descripcion = $_POST['nombre_examen'];
        $consentimientos=$_POST["selectconsentimiento"]; 

        $cod_examen = $examen->Crear_Examen($descripcion);
        for ($i=0;$i<count($consentimientos);$i++)    
{     
  $examen->crear_Examen_Consentimiento($cod_examen,$consentimientos[$i]); 
}
        if($examen){
          
            header("location:../examenes.php");
              }else{
              echo "No se Inserto";
              }
      }

      ?>