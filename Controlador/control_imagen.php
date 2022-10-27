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

$_SESSION["nombre_repres"] = "";
$_SESSION["parentesco_repres"] = "";
$_SESSION["documento_repres"] = "";
$id_cita = $_GET["id_cita"];
$cod_examen = $_GET["cod_examen"];
$cod_consentimiento = $_GET["cod_consentimiento"];
$nombre_repres= $_POST["nombre_representante"];
$_SESSION["nombre_repres"] = $nombre_repres;
$parentesco_repres= $_POST["parentesco_representante"];
$_SESSION["parentesco_repres"] = $parentesco_repres;
$documento_repres= $_POST["documento_representante"];
$_SESSION["documento_repres"] = $documento_repres;

if (isset($_POST['imagen'])) { 

    // mostrar la imagen
    //echo '<img src="'.$_POST['imagen'].'" border="1">';
    
    // funcion para gusrfdar la imagen base64 en el servidor
    // el nombre debe tener la extension
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
            $consentimiento = new ConsentimientoDao(); 
            $id_cita = $_GET["id_cita"];
            $cod_consentimiento = $_GET["cod_consentimiento"];
            $nombre = $id_cita.'.png';
            $consentimiento->Actualizar_Firma_Consentimiento($id_cita,$nombre);
            // retorno si todo fue bien
            header("location:../ver_consentimientos.php?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen . "&historial=false");
            return true;
        }
    }
    
    // llamamos a la funcion uploadImgBase64( img_base64, nombre_fina.png) 
    uploadImgBase64($_POST['imagen'], $id_cita);
    }

    header("location:../ver_consentimientos.php?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen . "&historial=false");
?>
