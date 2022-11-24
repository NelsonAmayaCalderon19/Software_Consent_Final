<?php
session_start();
if (!isset($_SESSION["usuario"])) {
  header("location:../index.php");
}
include_once '../Conexion/Conexion.php';
require '../modelo/Consentimiento.php';
include_once '../modelDao/ConsentimientoDao.php';
$conexion = new conexion();
$conexion = $conexion->connect();  
$consentimiento = new ConsentimientoDao();
$id_cita = $_GET["id_cita"];
$cod_examen = $_GET["cod_examen"];
$cod_consentimiento = $_SESSION["id_consentimiento"];

if($_POST["nombre_representante"]!=""){
$consentimiento->Guardar_Datos_Representante($id_cita,$_POST["nombre_representante"],$_POST["parentesco_representante"],$_POST["documento_representante"]);
}else{
$consentimiento->Guardar_Datos_Representante($id_cita,"No Aplica","No Aplica","No Aplica");
}
if (isset($_POST['imagen'])) { 

    function uploadImgBase64 ($base64, $id_cit){
        // decodificamos el base64
        $datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        // definimos la ruta donde se guardara en el server
        $path= '../firma_paciente_temp/'.$id_cit.'.png';
        
        // guardamos la imagen en el server
        if(!file_put_contents($path, $datosBase64)){
            // retorno si falla
            return false;
        }
        else{
   
            $nombre = $id_cita.'.png';
//header("location:../Controlador/Desplegar_Consentimiento.php?id_cita=119&cod_consentimiento=99921&cod_examen=1");
            header("location:../Controlador/Desplegar_Consentimiento.php?id_cita=" . $id_cita ."&cod_consentimiento=". $_SESSION["id_consentimiento"] ."&cod_examen=" . $cod_examen);
            return true;
        }
    }
    
    // llamamos a la funcion uploadImgBase64( img_base64, nombre_fina.png) 
    uploadImgBase64($_POST['imagen'], $id_cita);
    }

    header("location:../Controlador/Desplegar_Consentimiento.php?id_cita=" . $id_cita ."&cod_consentimiento=". $_SESSION["id_consentimiento"] ."&cod_examen=" . $cod_examen);
    //header("location:../Controlador/Desplegar_Consentimiento.php?id_cita=119&cod_consentimiento=99921&cod_examen=1");
?>
