<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
  <?php 
      include_once '../Conexion/Conexion.php';
      require '../modelo/Cita.php';
      include_once '../modelDao/CitaDao.php';
include_once '../javaScript/script_sweet.js';
      $conexion = new conexion();
$conexion = $conexion->connect();
$cita = new CitaDao();
      if(filter_input(INPUT_POST, 'btnAcepta')){
        $nombre = $_POST['nombres_paciente'];
        $apellido = $_POST['apellidos_paciente'];
        $documento = $_POST["documento"];
        $tipo_documento = $_POST['selecttipodocumento'];
        $edad = $_POST["edad"];
        $afiliacion = $_POST['afiliacion'];
        $aseguradora = $_POST["aseguradora"];
        $regimen = $_POST["selectregimen"];       
        $sexo = $_POST["selectsexo"];
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        $examen = $_POST["selectexamen"];
        $tipoexamen = $_POST["selecttipoexamen"];
        $medico = $_POST["selectmedico"];
        $consultorio = $_POST["selectconsultorio"];
        $sede = $_POST["selectsede"];
        $esquema_clinico = $_POST["selectesquema"];

        $cod = $cita->Guardar_Cita_Extraordinaria($nombre,$apellido,$documento,$tipo_documento,$edad,$afiliacion,$aseguradora,$regimen,$sexo,$fecha,$hora,$medico,$consultorio,$tipoexamen,$examen,$sede,"3",$esquema_clinico);
        $sq="SELECT * FROM consent_examen as exam WHERE exam.cod_examen= :id";
        $result=$conexion->prepare($sq);
        $result->execute(array(
        ':id' =>"".$examen.""
        ));
        $results = $result -> fetchAll();
        $dir = array();
        $cont = 0;
        foreach($results as $fila):         
          $cita->Agregar_Consentimiento_Cita($cod,$fila["cod_consentimiento"],6);
        endforeach;
        if($cita){
          

          echo '<script>
        Swal.fire({
         icon: "success",
         title: "Proceso Exitoso",
         text: "La Cita se Creó Satisfactoriamente",
         showConfirmButton: true,
         confirmButtonText: "Cerrar"
         }).then(function(result){
            if(result.value){                   
             window.location = "../principal.php";
            }
         });
        </script>';
            }else{
            echo "No se Inserto";
            }
      }
  ?>      