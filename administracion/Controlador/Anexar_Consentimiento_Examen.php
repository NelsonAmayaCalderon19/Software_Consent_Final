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
        $codigo = $_POST['codigo_examen'];
        $consentimientos=$_POST["selectconsentimiento"]; 

        for ($i=0;$i<count($consentimientos);$i++)    
{     
  $examen->crear_Examen_Consentimiento($codigo,$consentimientos[$i]); 
}
        if($examen){
          

            echo '<script>
            Swal.fire({
             icon: "success",
             title: "Proceso Exitoso",
             text: "Se Anexó el Consentimiento al Examen Satisfactoriamente",
             showConfirmButton: true,
             confirmButtonText: "Cerrar"
             }).then(function(result){
                if(result.value){                   
                 window.location = "../informacion_examen.php?cod_examen='. $codigo .'";
                }
             });
            </script>';
                }else{
                echo "No se Inserto";
                }
        
      }

      ?>