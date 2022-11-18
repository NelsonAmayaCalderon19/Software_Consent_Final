<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location: ../index.php");
  }
  ?>
<?php
include_once '../Conexion/Conexion.php';
require '../modelo/Consentimiento.php';
include_once '../modelDao/ConsentimientoDao.php';
require '../modelo/Cita.php';
include_once '../modelDao/CitaDao.php';
include_once '../javaScript/script_sweet.js';
$consentimiento = new ConsentimientoDao();
$cita = new CitaDao();
$id_cita = $_GET["id_cita"];
$cod_examen = $_GET["cod_examen"];
if(filter_input(INPUT_POST, 'btnConfirma')){
    if(!empty($_POST['check_list'])){
        // Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
        foreach($_POST['check_list'] as $selected){
       // echo $selected."</br>";
        $cita->Agregar_Consentimiento_Cita($id_cita,$selected,6);
        }
        $consentimiento->Retornar_Estado_Inicial_Cita($id_cita);
        header("Refresh: 1; URL=../ver_consentimientos.php?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen. "&historial=false");

    echo '<script>
    Swal.fire({
     icon: "success",
     title: "Proceso Exitoso",
     text: "Consentimiento Anexado Satisfactoriamente",
     showConfirmButton:false,
     });
    </script>';
    
    }else{
        header("Refresh: 1; URL=../ver_consentimientos.php?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen. "&historial=false");
        echo '<script>
        Swal.fire({
         icon: "error",
         title: "Proceso No Realizado",
         text: "Recuerde Seleccionar al menos 1 Consentimiento, para poder continuar",
         showConfirmButton:false,
         });
        </script>';
      }
   
}





?>