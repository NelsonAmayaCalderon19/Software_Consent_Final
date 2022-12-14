<?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:index.php");
  }
  ?>
  <?php 
      include_once '../Conexion/Conexion.php';
      require '../modelo/Consentimiento.php';
      include_once '../modelDao/ConsentimientoDao.php';
      require '../modelo/Profesional.php';
      include_once '../modelDao/ProfesionalDao.php';
      require '../modelo/Cita.php';
      include_once '../modelDao/CitaDao.php';
      include_once '../javaScript/script_sweet.js';
      require_once dirname(__FILE__).'/PHPWord-develop/src/PhpWord/Autoloader.php';
      $consentimiento = new ConsentimientoDao();
      $profesional = new ProfesionalDao();
      $cita = new CitaDao();
      \PhpOffice\PhpWord\Autoloader::register();
      use PhpOffice\PhpWord\Element\AbstractContainer;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Shared\Html;

use PhpOffice\PhpWord\TemplateProcessor;
      $id_cita = $_GET["id_cita"];
      $id_consentimiento = $_GET["cod_consentimiento"];
      $cod_examen = $_GET["cod_examen"];
  //    $eliminar_archivo = $_GET["borrar_archivo"];
      $ruta_firma = $id_cita.".png";
      $_SESSION["aceptRech"] = "";
      $_SESSION["selectPro"] = "";
      //$firma = $_GET["firma"];
      $id_estado;
      $datos_repre = $consentimiento->Consultar_Datos_Representante($id_cita);
      if(filter_input(INPUT_POST, 'btnAcepta') || filter_input(INPUT_POST, 'btnAcepta2')){
        if($datos_repre[0]=="" && filter_input(INPUT_POST, 'btnAcepta')){
          if($id_consentimiento == "FT-PA-GI-HC-235"){
            if($consentimiento->Consultar_Firmante_Consentimiento($id_consentimiento) == "MEDICO"){
              //$cita->Actualizar_Medico_Cita($id_cita,$_POST["selectprofesional"],$_POST['selecttipodocumento'],$_POST["selectsexo"]);
              
              /*$_SESSION["direccion"] = $_POST["direc"];
              $_SESSION["telefono"] = $_POST["telefono"];
              $_SESSION["expedicion"] = $_POST["lugar_exp"];*/
              $_SESSION["aceptRech"] = $_POST["flexRadioDefault"];
              $_SESSION["id_consentimiento"] = $_GET["cod_consentimiento"];
            }else{
              if($_POST["selectprofesional"] != ""){
                $_SESSION["selectPro"] = $_POST["selectprofesional"];
              }
             
             /* $_SESSION["direccion"] = $_POST["direc"];
              $_SESSION["telefono"] = $_POST["telefono"];
              $_SESSION["expedicion"] = $_POST["lugar_exp"];*/
              $_SESSION["aceptRech"] = $_POST["flexRadioDefault"];
              $_SESSION["id_consentimiento"] = $_GET["cod_consentimiento"];
            }
          }else{
          if($consentimiento->Consultar_Firmante_Consentimiento($id_consentimiento) == "MEDICO"){
            $cita->Actualizar_Medico_Cita($id_cita,$_POST["selectprofesional"],$_POST['selecttipodocumento'],$_POST["selectsexo"]);
            if($_POST["inquietudes"]!=""){
              $consentimiento->Anadir_Inquietude($id_cita,$id_consentimiento,$_POST["inquietudes"],$_POST["respuesta"]);
              }
            $_SESSION["aceptRech"] = $_POST["flexRadioDefault"];
            $_SESSION["id_consentimiento"] = $_GET["cod_consentimiento"];
          }else{
            if($_POST["selectprofesional"] != ""){
              $_SESSION["selectPro"] = $_POST["selectprofesional"];
            }
           
            $cita->Actualizar_Info_Cita($id_cita,$_POST['selecttipodocumento'],$_POST["selectsexo"]);
            if($_POST["inquietudes"]!=""){
              $consentimiento->Anadir_Inquietude($id_cita,$id_consentimiento,$_POST["inquietudes"],$_POST["respuesta"]);
            }
            $_SESSION["aceptRech"] = $_POST["flexRadioDefault"];
            $_SESSION["id_consentimiento"] = $_GET["cod_consentimiento"];
          }
        }
          header("Refresh: 2; URL=../ver_consentimientos.php?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen ."&historial=false". "&solicitar=true");
          echo '<script>
          Swal.fire({
           icon: "info",
           title: "Se??or Usuario",
           text: "Por favor, proceda a firma el consentimiento, en caso de incapacidad, favor firmar el Representante Legal",
           showConfirmButton: true
           });
          </script>';
         }else{
      $ruta = $consentimiento->Consultar_Archivo_Consentimiento($id_consentimiento);
      $firmante_rol = $consentimiento->Consultar_Firmante_Consentimiento($id_consentimiento);
      if($firmante_rol=="MEDICO"){
      if($id_consentimiento != "FT-PA-GI-HC-235"){
        if(@file_get_contents('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx')){
          $templateWord = new TemplateProcessor('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
          $_SESSION["aceptRech"] = "";
          $_SESSION["selectPro"]="";
          }else{
          
$templateWord = new TemplateProcessor('../formatos/' . $ruta);
$names = explode(" ",$_POST["nombre_paciente"]);
$num_nombres = count($names);
$primer_nombre = $segundo_nombre = "";
switch ($num_nombres) {
    case 1: 
        $primer_nombre = $names[0];
        break;
    case 2:
        $primer_nombre    = $names[0];
        $segundo_nombre = $names[1];
        break;
    case 3:
        $segundo_nombre = $names[1] . ' ' . $names[2];
        $primer_nombre   = $names[0];
    case 4:
          $segundo_nombre = $names[1] . ' ' . $names[2] . ' ' . $names[3];
          $primer_nombre   = $names[0];
    default:
        break;
}

$apellidos = explode(" ",$_POST["apellido_paciente"]);
$num_apellidos = count($apellidos);
$primer_apellido = $segundo_apellido = "";
switch ($num_apellidos) {
    case 1: 
        $primer_apellido = $apellidos[0];
        break;
    case 2:
        $primer_apellido   = $apellidos[0];
        $segundo_apellido = $apellidos[1];
        break;
    case 3:
        $segundo_apellido = $apellidos[1] . ' ' . $apellidos[2];
        $primer_apellido   = $apellidos[0];
    case 4:
          $segundo_apellido = $apellidos[1] . ' ' . $apellidos[2] . ' ' . $apellidos[3];
          $primer_apellido   = $apellidos[0];
    default:
        break;
}
//$nombres    = mb_convert_case($nombres, MB_CASE_TITLE, 'UTF-8');
//$apellidos  = mb_convert_case($apellidos, MB_CASE_TITLE, 'UTF-8');

        
        $tipo_documento = $_POST['selecttipodocumento'];
        $documento = $_POST["documento"];
        $aseguradora = $_POST["aseguradora"];
        $regimen = $_POST["regimen"];
        $edad = $_POST["edad"];
        $selectsexo = $_POST["selectsexo"];
        $cita->Actualizar_Cita_($id_cita,$tipo_documento,$selectsexo);
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        $selectprofesional = $_POST["selectprofesional"];
        $firmaProfesional = $profesional->Consultar_Firma_Profesional($selectprofesional);
        /*if($_POST["inquietudes"]!=""){
        $inquietudes = $_POST["inquietudes"];
        $templateWord->setValue('inquietud',$inquietudes);
        }*/
        //$respuesta = $_POST["respuesta"];
        $acepRech = $_POST["flexRadioDefault"];
       if($datos_repre[0]=="No Aplica"){
        $nombre_representante= "";
        $parentesco_representante= "";
        $documento_representante= "";
       }else{
        $nombre_representante= $datos_repre[0];
        $parentesco_representante= $datos_repre[1];
        $documento_representante= $datos_repre[2];
       }
$templateWord->setValue('primer_nombre',$primer_nombre);
$templateWord->setValue('segundo_nombre',$segundo_nombre);
$templateWord->setValue('primer_apellido',$primer_apellido);
$templateWord->setValue('segundo_apellido',$segundo_apellido);
$templateWord->setValue('tipo_documento',$tipo_documento);
$templateWord->setValue('documento',$documento);
$templateWord->setValue('aseguradora',$aseguradora);
$templateWord->setValue('afiliar',$regimen);
$templateWord->setValue('edad',$edad);
$templateWord->setValue('sexo',$selectsexo);
$templateWord->setValue('fecha',$fecha);
$templateWord->setValue('hora',$hora);

//$templateWord->setValue('respuesta',$respuesta);

if($_POST["flexRadioDefault"] == "S??"){
    $templateWord->setValue('ace',"X");
    $templateWord->setValue('rec',"");
    $id_estado="7";
    if($datos_repre[0] == "No Aplica"){
    $templateWord->setImageValue('firma_paciente_acepta', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));
    $templateWord->setValue('cedula_paciente',$documento);
    $templateWord->setValue('firma_representante',"");
  }else{
      $templateWord->setImageValue('firma_representante', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 180, 'height' => 50, 'ratio' => false));
      $templateWord->setValue('firma_paciente_acepta',"");
      $templateWord->setValue('cedula_paciente',"");
    }
}else if($_POST["flexRadioDefault"] =="No"){
    $templateWord->setValue('rec',"X");
    $templateWord->setValue('ace',"");
    $id_estado="8";
    if($datos_repre[0] == "No Aplica"){
      $templateWord->setImageValue('firma_paciente_acepta', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));
      $templateWord->setValue('cedula_paciente',$documento);
      $templateWord->setValue('firma_representante',"");
    }else{
        $templateWord->setImageValue('firma_representante', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 180, 'height' => 50, 'ratio' => false));
        $templateWord->setValue('firma_paciente_acepta',"");
        $templateWord->setValue('cedula_paciente',"");
      }
}
$templateWord->setValue('nombre_representante',$nombre_representante);
$templateWord->setValue('parentesco_representante',$parentesco_representante);
$templateWord->setValue('documento_representante',$documento_representante);
$templateWord->setValue('cedula_profesional',$selectprofesional);
$templateWord->setValue('firma_paciente_rechaza', "");
$templateWord->setValue('firma_representante_rechaza',"");
$templateWord->setImageValue('firma_profesional', array('path' => '../FirmasProfesionales/' . $firmaProfesional[0], 'width' => 200, 'height' => 60, 'ratio' => false));
          }
          if($_POST["inquietudes"]!="" && $_POST["respuesta"]!=""){
$inquietudes = $_POST["inquietudes"];
$reemp_inq = nl2br(htmlentities($inquietudes));
$texto_inq = new TextRun();
Html::addHtml($texto_inq, $reemp_inq);
$respuesta = $_POST["respuesta"];
$reemp_res = nl2br(htmlentities($respuesta));
$texto_res = new TextRun();
Html::addHtml($texto_res, $reemp_res);
//$templateWord->setValue('inquietud',$inquietudes);
$templateWord->setComplexValue('inquietud',$texto_inq);
$templateWord->setComplexValue('respuesta',$texto_res);
//$templateWord->setValue('respuesta',$respuesta);
$consentimiento->Editar_Inquietud_Consentimiento($id_cita,$id_consentimiento,$inquietudes,$respuesta);
          }if(!$_POST["inquietudes"]!="" && !$_POST["respuesta"]!=""){
            $respuesta = "";
            $reemp_res = nl2br(htmlentities($respuesta));
            $texto_res = new TextRun();
            Html::addHtml($texto_res, $reemp_res);
            //$templateWord->setValue('respuesta',$respuesta);
            $templateWord->setComplexValue('respuesta',$texto_res);
            $inquietudes = "";
                      $reemp_inq = nl2br(htmlentities($inquietudes));
                      $texto_inq = new TextRun();
                      Html::addHtml($texto_inq, $reemp_inq);
                      $templateWord->setComplexValue('inquietud',$texto_inq);
                     
            //unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
          }
          
          if($_POST["inquietudes"]!=""){
            $inquietudes = $_POST["inquietudes"];
            $reemp_inq = nl2br(htmlentities($inquietudes));
            $texto_inq = new TextRun();
            Html::addHtml($texto_inq, $reemp_inq);
            //$respuesta = $_POST["respuesta"];
            //$templateWord->setValue('inquietud',$inquietudes);
            $templateWord->setComplexValue('inquietud',$texto_inq);
            $consentimiento->Editar_Inquietud_Consentimiento($id_cita,$id_consentimiento,$inquietudes,NULL);
            //$templateWord->setValue('respuesta',$respuesta);
           }else if($_POST["respuesta"]!=""){
            //$inquietudes = $_POST["inquietudes"];
            $respuesta = $_POST["respuesta"];
            $reemp_res = nl2br(htmlentities($respuesta));
            $texto_res = new TextRun();
            Html::addHtml($texto_res, $reemp_res);
            //$templateWord->setValue('respuesta',$respuesta);
            $templateWord->setComplexValue('respuesta',$texto_res);
            $consentimiento->Editar_Inquietud_Consentimiento($id_cita,$id_consentimiento,NULL,$respuesta);
           }
            //$respuesta = $_POST["respuesta"];
//$templateWord->saveAs('../formatos/Plantilla/'. $ruta);
//$archivo_binario = (file_get_contents('../formatos/Plantilla/'. $ruta));
$templateWord->saveAs('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
$archivo_binario = (file_get_contents('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx'));
if(!$_POST["inquietudes"]!="" && !$_POST["respuesta"]!=""){
  unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
}
if($_POST["respuesta"]!="" || $id_estado=="8"){
  unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
  $consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);

  //unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
  //$consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);
  if($id_estado!= ""){
    $consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,$id_estado,$archivo_binario);
    }else{
      $consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,7,$archivo_binario);
    }
}else{
  $consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,$id_estado,$archivo_binario);
}
 
//$consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,7,$archivo_binario);
$validarConsentCita=$consentimiento->Validar_Consentimientos_Cita_Firmados($id_cita);
$validar_Sin_Firma_Venopuncion=$consentimiento->Validar_Consentimientos_Cita_Firmados_Sin_Firma_Pendiente($id_cita);
$validar_Pendientes=$consentimiento->Validar_Consentimientos_Cita_Pendientes($id_cita);
if($validarConsentCita=="0"){
  array_map('unlink', array_filter(
    (array) array_merge(glob("../firma_paciente_temp/".$ruta_firma))));
$consentimiento->Actualizar_Estado_Cita($id_cita);
//$consentimiento->Resetear_Datos_Representante($id_cita);
$_SESSION["aceptRech"] = "";
}if($validar_Sin_Firma_Venopuncion!="0" && $validar_Pendientes=="0"){
  $consentimiento->Actualizar_Estado_Cita($id_cita);
//$consentimiento->Resetear_Datos_Representante($id_cita);
$_SESSION["aceptRech"] = "";
}
      //echo $ruta." ".$nombre_paciente." ".$apellido_paciente." ".$tipo_documento." ".$documento." ".$aseguradora." ".$regimen;
      /*echo $nombre_paciente;
      echo $apellido_paciente;*/
      header("location:../ver_consentimientos.php"  . "?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen ."&historial=false&solicitar=false");
      unlink('../formatos/Plantilla/'. $ruta);
      $_SESSION["aceptRech"] = "";
}else if($id_consentimiento == "FT-PA-GI-HC-235"){
  $templateWord = new TemplateProcessor('../formatos/' . $ruta);
  $id_estado="";
  /*header("Refresh: 2; URL=../ver_consentimientos.php?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen ."&historial=false". "&solicitar=true");
  echo '<script>
  Swal.fire({
   icon: "info",
   title: "Se??or Usuario",
   text: "Por favor, proceda a firma el consentimiento, en caso de incapacidad, favor firmar el Representante Legal",
   showConfirmButton: true
   });
  </script>';*/
 //$tipo_documento = $_POST['selecttipodocumento'];
  $nombre = $_POST["nombre_paciente"];
  $apellido = $_POST["apellido_paciente"];
  $documento = $_POST["documento"];
  $eps = $_POST["eps"];
  $edad = $_POST["edad"];
  //$telefono = $_POST["telefono"];
  //$fecha = $_POST["fecha"];
  //$direccion = $_POST["direc"];
  $selectprofesional = $_POST["selectprofesional"];
  $firmaProfesional = $profesional->Consultar_Firma_Profesional($selectprofesional);
  $firmaProfesion = $profesional->Consultar_Datos_Profesional($selectprofesional);
  $acepRech = $_POST["flexRadioDefault"];

  if($_POST["flexRadioDefault"] == "S??"){
     $templateWord->setValue('ace',"X");
     $templateWord->setValue('rec',"");
    $id_estado="7";
    $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
    if($datos_repre[0] == "No Aplica"){
      $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
      $templateWord->setValue('cedula_paciente',$documento);
      $templateWord->setValue('si_pac',"X");
      $templateWord->setValue('no_pac',"");
      $templateWord->setValue('si_rec_pac',"");
      $templateWord->setValue('no_rec_pac',"");
     // $templateWord->setValue('firma_representante',"");
    }else{
      $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
      $templateWord->setValue('cedula_paciente',$documento);
      $templateWord->setValue('si_pac',"");
      $templateWord->setValue('no_pac',"");
      $templateWord->setValue('si_rec_pac',"X");
      $templateWord->setValue('no_rec_pac',"");
      }
}else if($_POST["flexRadioDefault"] =="No"){
    $templateWord->setValue('rec',"X");
    $templateWord->setValue('ace',"");
    $id_estado="8";
      $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));
      if($datos_repre[0] == "No Aplica"){
        $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
        $templateWord->setValue('cedula_paciente',$documento);
        $templateWord->setValue('si_pac',"");
        $templateWord->setValue('no_pac',"X");
        $templateWord->setValue('si_rec_pac',"");
        $templateWord->setValue('no_rec_pac',"");
       // $templateWord->setValue('firma_representante',"");
      }else{
        $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
        $templateWord->setValue('cedula_paciente',$documento);
        $templateWord->setValue('si_pac',"");
        $templateWord->setValue('no_pac',"");
        $templateWord->setValue('si_rec_pac',"");
        $templateWord->setValue('no_rec_pac',"X");
        }
    }
    $partes = explode("-", $_POST["fecha"]);
    $dia = $partes[2];
    $mes = $partes[1];  
    $anio = $partes[0]; 
    $templateWord->setValue('dia',$dia);
    $templateWord->setValue('mes',$mes);
    $templateWord->setValue('anio',$anio);
$nombre_completo = $nombre." ".$apellido;
$templateWord->setValue('nombre',$nombre);
$templateWord->setValue('apellido',$apellido);
$templateWord->setValue('nombre_completo',$nombre_completo);
$templateWord->setValue('documento',$documento);
$templateWord->setValue('documento2',$documento);
$templateWord->setValue('eps',$eps);
$templateWord->setValue('edad',$edad);
$templateWord->setValue('nombre_pro',$firmaProfesion[1]);
$templateWord->setValue('ced_pro',$firmaProfesion[0]);
//$templateWord->setValue('telefono',$telefono);
//$templateWord->setValue('ciudad',"San Jose De Cucuta");
$templateWord->setImageValue('fima_profesional', array('path' => '../FirmasProfesionales/' . $firmaProfesional[0], 'width' => 200, 'height' => 60, 'ratio' => false));

$templateWord->saveAs('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
$archivo_binario = (file_get_contents('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx'));

$consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,$id_estado,$archivo_binario);
  
$validarConsentCita=$consentimiento->Validar_Consentimientos_Cita_Firmados($id_cita);
$validar_Sin_Firma_Venopuncion=$consentimiento->Validar_Consentimientos_Cita_Firmados_Sin_Firma_Pendiente($id_cita);
$validar_Pendientes=$consentimiento->Validar_Consentimientos_Cita_Pendientes($id_cita);
if($validarConsentCita=="0"){
  array_map('unlink', array_filter(
    (array) array_merge(glob("../firma_paciente_temp/".$ruta_firma))));
$consentimiento->Actualizar_Estado_Cita($id_cita);
//$consentimiento->Resetear_Datos_Representante($id_cita);
$_SESSION["aceptRech"] = "";
/*$_SESSION["direccion"] = "";
$_SESSION["telefono"] = "";
$_SESSION["expedicion"] = "";*/

}if($validar_Sin_Firma_Venopuncion!="0" && $validar_Pendientes=="0"){
  $consentimiento->Actualizar_Estado_Cita($id_cita);
//$consentimiento->Resetear_Datos_Representante($id_cita);
$_SESSION["aceptRech"] = "";
/*$_SESSION["direccion"] = "";
$_SESSION["telefono"] = "";
$_SESSION["expedicion"] = "";*/
}
      //echo $ruta." ".$nombre_paciente." ".$apellido_paciente." ".$tipo_documento." ".$documento." ".$aseguradora." ".$regimen;
      /*echo $nombre_paciente;
      echo $apellido_paciente;*/
      header("location:../ver_consentimientos.php"  . "?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen ."&historial=false&solicitar=false");
      unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
$_SESSION["aceptRech"] = "";
/*$_SESSION["direccion"] = "";
$_SESSION["telefono"] = "";
$_SESSION["expedicion"] = "";*/
}
      }else{
        if($id_consentimiento != "FT-PA-GI-HC-235"){
        if(@file_get_contents('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx')){
        $templateWord = new TemplateProcessor('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
        $_SESSION["aceptRech"] = "";
        $_SESSION["selectPro"]="";
        }else{
$templateWord = new TemplateProcessor('../formatos/' . $ruta);

      
$names = explode(" ",$_POST["nombre_paciente"]);
$num_nombres = count($names);
$primer_nombre = $segundo_nombre = "";
switch ($num_nombres) {
    case 1: 
        $primer_nombre = $names[0];
        break;
    case 2:
        $primer_nombre    = $names[0];
        $segundo_nombre = $names[1];
        break;
    case 3:
        $segundo_nombre = $names[1] . ' ' . $names[2];
        $primer_nombre   = $names[0];
    case 4:
          $segundo_nombre = $names[1] . ' ' . $names[2] . ' ' . $names[3];
          $primer_nombre   = $names[0];
    default:
        break;
}

$apellidos = explode(" ",$_POST["apellido_paciente"]);
$num_apellidos = count($apellidos);
$primer_apellido = $segundo_apellido = "";
switch ($num_apellidos) {
    case 1: 
        $primer_apellido = $apellidos[0];
        break;
    case 2:
        $primer_apellido   = $apellidos[0];
        $segundo_apellido = $apellidos[1];
        break;
    case 3:
        $segundo_apellido = $apellidos[1] . ' ' . $apellidos[2];
        $primer_apellido   = $apellidos[0];
    case 4:
          $segundo_apellido = $apellidos[1] . ' ' . $apellidos[2] . ' ' . $apellidos[3];
          $primer_apellido   = $apellidos[0];
    default:
        break;
}
$tipo_documento = $_POST['selecttipodocumento'];
$documento = $_POST["documento"];
$aseguradora = $_POST["aseguradora"];
$regimen = $_POST["regimen"];
$edad = $_POST["edad"];
$selectsexo = $_POST["selectsexo"];
$cita->Actualizar_Cita_($id_cita,$tipo_documento,$selectsexo);
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];

//$inquietudes = $_POST["inquietudes"];
//$respuesta = $_POST["respuesta"];
$acepRech = $_POST["flexRadioDefault"];

if($datos_repre[0]=="No Aplica"){
  $nombre_representante= "";
  $parentesco_representante= "";
  $documento_representante= "";
 }else{
  $nombre_representante= $datos_repre[0];
  $parentesco_representante= $datos_repre[1];
  $documento_representante= $datos_repre[2];
 }
/*$primer_nombre = $nombre_paciente[0];    
$segundo_nombre = $nombre_paciente[1];   
$primer_apellido = $apellido_paciente[0];    
$segundo_apellido = $apellido_paciente[1]; */
$templateWord->setValue('primer_nombre',$primer_nombre);
$templateWord->setValue('segundo_nombre',$segundo_nombre);
$templateWord->setValue('primer_apellido',$primer_apellido);
$templateWord->setValue('segundo_apellido',$segundo_apellido);
$templateWord->setValue('tipo_documento',$tipo_documento);
$templateWord->setValue('documento',$documento);
$templateWord->setValue('aseguradora',$aseguradora);
$templateWord->setValue('afiliar',$regimen);
$templateWord->setValue('edad',$edad);
$templateWord->setValue('sexo',$selectsexo);
$templateWord->setValue('fecha',$fecha);
$templateWord->setValue('hora',$hora);
//$templateWord->setValue('inquietud',$inquietudes);
//$templateWord->setValue('respuesta',$respuesta);
$ruta_firma = $id_cita.".png";
if($_POST["flexRadioDefault"] == "S??"){
$templateWord->setValue('ace',"X");
$templateWord->setValue('rec',"");
$id_estado="7";
if($datos_repre[0] == "No Aplica"){
$templateWord->setImageValue('firma_paciente_acepta', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));
$templateWord->setValue('cedula_paciente',$documento);
$templateWord->setValue('firma_representante',"");
}else{
$templateWord->setImageValue('firma_representante', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 180, 'height' => 50, 'ratio' => false));
$templateWord->setValue('firma_paciente_acepta',"");
$templateWord->setValue('cedula_paciente',"");
}
}else if($_POST["flexRadioDefault"] =="No"){
$templateWord->setValue('rec',"X");
$templateWord->setValue('ace',"");
$id_estado="8";
if($datos_repre[0] == "No Aplica"){
$templateWord->setImageValue('firma_paciente_acepta', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));
$templateWord->setValue('cedula_paciente',$documento);
$templateWord->setValue('firma_representante',"");
}else{
$templateWord->setImageValue('firma_representante', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 180, 'height' => 50, 'ratio' => false));
$templateWord->setValue('firma_paciente_acepta',"");
$templateWord->setValue('cedula_paciente',"");
}
}
$templateWord->setValue('nombre_representante',$nombre_representante);
$templateWord->setValue('parentesco_representante',$parentesco_representante);
$templateWord->setValue('documento_representante',$documento_representante);
        }
        if($id_estado== "8"){
          $templateWord->setValue('cedula_profesional',"");
$templateWord->setValue('firma_profesional',"");

        }
if($_POST["selectprofesional"] != ""){
  $selectprofesional = $_POST["selectprofesional"];
$firmaProfesional = $profesional->Consultar_Firma_Profesional($selectprofesional);
$templateWord->setValue('cedula_profesional',$selectprofesional);
$templateWord->setImageValue('firma_profesional', array('src' => '../FirmasProfesionales/' . $firmaProfesional[0], 'width' => 200, 'height' => 60, 'ratio' => false));
}
//$templateWord->setValue('cedula_profesional',$selectprofesional);
$templateWord->setValue('firma_paciente_rechaza', "");
$templateWord->setValue('firma_representante_rechaza',"");
//$templateWord->setImageValue('firma_profesional', array('src' => '../FirmasProfesionales/' . $firmaProfesional[0],'swh'=>'250'));
if($_POST["inquietudes"]!="" || $_POST["respuesta"]!=""){
  if($_POST["inquietudes"]!=""){
  $inquietudes = $_POST["inquietudes"];
  $reemp_inq = nl2br(htmlentities($inquietudes));
  $texto_inq = new TextRun();
  Html::addHtml($texto_inq, $reemp_inq);
  $templateWord->setComplexValue('inquietud',$texto_inq);
  }
  if($_POST["respuesta"]!=""){
  $respuesta = $_POST["respuesta"];
  $reemp_res = nl2br(htmlentities($respuesta));
  $texto_res = new TextRun();
  Html::addHtml($texto_res, $reemp_res);
  //$templateWord->setValue('inquietud',$inquietudes);
  
  $templateWord->setComplexValue('respuesta',$texto_res);
}else if($_POST["flexRadioDefault"] =="No"){
  $respuesta = "";
  $reemp_res = nl2br(htmlentities($respuesta));
  $texto_res = new TextRun();
  Html::addHtml($texto_res, $reemp_res);
  //$templateWord->setValue('inquietud',$inquietudes);
  
  $templateWord->setComplexValue('respuesta',$texto_res);
}
  //$templateWord->setValue('respuesta',$respuesta);
  $consentimiento->Editar_Inquietud_Consentimiento($id_cita,$id_consentimiento,$inquietudes,$respuesta);
            }else if(!$_POST["inquietudes"]!="" || !$_POST["respuesta"]!=""){
              if($_POST["selectprofesional"]!=""){
              $respuesta = '${respuesta}';
              $reemp_res = nl2br(htmlentities($respuesta));
              $texto_res = new TextRun();
              Html::addHtml($texto_res, $reemp_res);
              //$templateWord->setValue('respuesta',$respuesta);
              $templateWord->setComplexValue('respuesta',$texto_res);
              $inquietudes = '${inquietud}';
                        $reemp_inq = nl2br(htmlentities($inquietudes));
                        $texto_inq = new TextRun();
                        Html::addHtml($texto_inq, $reemp_inq);
                        $templateWord->setComplexValue('inquietud',$texto_inq);
                        if($consentimiento->Consultar_Pregunta_Consentimiento($id_cita,$id_consentimiento)==""){

                          $respuesta = "";
              $reemp_res = nl2br(htmlentities($respuesta));
              $texto_res = new TextRun();
              Html::addHtml($texto_res, $reemp_res);
              //$templateWord->setValue('respuesta',$respuesta);
              $templateWord->setComplexValue('respuesta',$texto_res);
              $inquietudes = "";
                        $reemp_inq = nl2br(htmlentities($inquietudes));
                        $texto_inq = new TextRun();
                        Html::addHtml($texto_inq, $reemp_inq);
                        $templateWord->setComplexValue('inquietud',$texto_inq);
                        }

              }else if($_POST["selectprofesional"]==""){
                $respuesta = "";
              $reemp_res = nl2br(htmlentities($respuesta));
              $texto_res = new TextRun();
              Html::addHtml($texto_res, $reemp_res);
              //$templateWord->setValue('respuesta',$respuesta);
              $templateWord->setComplexValue('respuesta',$texto_res);
              $inquietudes = "";
                        $reemp_inq = nl2br(htmlentities($inquietudes));
                        $texto_inq = new TextRun();
                        Html::addHtml($texto_inq, $reemp_inq);
                        $templateWord->setComplexValue('inquietud',$texto_inq);
              }  
              //unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
            }/*else if($_POST["inquietudes"]!=""){
              $inquietudes = $_POST["inquietudes"];
              $reemp_inq = nl2br(htmlentities($inquietudes));
              $texto_inq = new TextRun();
              Html::addHtml($texto_inq, $reemp_inq);
              //$respuesta = $_POST["respuesta"];
              //$templateWord->setValue('inquietud',$inquietudes);
              $templateWord->setComplexValue('inquietud',$texto_inq);
              $consentimiento->Editar_Inquietud_Consentimiento($id_cita,$id_consentimiento,$inquietudes,NULL);
              //$templateWord->setValue('respuesta',$respuesta);
             }else if($_POST["respuesta"]!=""){
              //$inquietudes = $_POST["inquietudes"];
              $respuesta = $_POST["respuesta"];
              $reemp_res = nl2br(htmlentities($respuesta));
              $texto_res = new TextRun();
              Html::addHtml($texto_res, $reemp_res);
              //$templateWord->setValue('respuesta',$respuesta);
              $templateWord->setComplexValue('respuesta',$texto_res);
              $consentimiento->Editar_Inquietud_Consentimiento($id_cita,$id_consentimiento,NULL,$respuesta);
             }*/
             
$templateWord->saveAs('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');

$archivo_binario = (file_get_contents('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx'));

/*if($_POST["respuesta"]!=""){
  $consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);
  /*$respuesta = "";
              $reemp_res = nl2br(htmlentities($respuesta));
              $texto_res = new TextRun();
              Html::addHtml($texto_res, $reemp_res);
              //$templateWord->setValue('respuesta',$respuesta);
              $templateWord->setComplexValue('respuesta',$texto_res);
  unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
  $consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);
  
    $consentimiento->Actualizar_Cita_Consentimiento_Archivo($id_cita,$id_consentimiento,$archivo_binario);
    */
//}

if($_POST["selectprofesional"]!= "" || $id_estado=="8"){
  if($id_estado== "8"){
    $consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);
    unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
  }
  $consentimiento->Actualizar_Consentimiento_firmado_Profesional($id_cita,$id_consentimiento,"true");
  if($consentimiento->Consultar_Pregunta_Consentimiento($id_cita,$id_consentimiento)==""){
    $consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);
  unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
  }else if($consentimiento->Consultar_Estado_Consentimiento2($id_cita,$id_consentimiento)=="6" && $_POST["respuesta"]!=""){
    $consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);
    unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
  }
    if($id_estado!= ""){
      $consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,$id_estado,$archivo_binario);
      }else{
        $consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,7,$archivo_binario);
      }
    $validarConsentCita=$consentimiento->Validar_Consentimientos_Cita_Firmados($id_cita);
    
  }else if($_POST["respuesta"]!=""){
    $consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);
    $firmado = $consentimiento->Consultar_Firmado_Consentimiento($id_cita,$id_consentimiento);
    if($consentimiento->Consultar_Pregunta_Consentimiento($id_cita,$id_consentimiento)=="" && $firmado == "true"){
      //$consentimiento->Resetear_Inquietudes($id_cita,$id_consentimiento);
      $consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,7,$archivo_binario);
    unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
    }
    $estad = $consentimiento->Consultar_Estado_Consentimiento2($id_cita,$id_consentimiento);
    if($estad == "6"){
      $consentimiento->Actualizar_Estado_Consentimiento_Venopuncion($id_cita,$id_consentimiento,10);
$consentimiento->Actualizar_Consentimiento_firmado_Profesional($id_cita,$id_consentimiento,"false");
$validar_Sin_Firma_Venopuncion=$consentimiento->Validar_Consentimientos_Cita_Firmados_Sin_Firma_Pendiente($id_cita);
$validar_Pendientes=$consentimiento->Validar_Consentimientos_Cita_Pendientes($id_cita);
    }
  }else if($_POST["selectprofesional"]== ""){
$consentimiento->Actualizar_Estado_Consentimiento_Venopuncion($id_cita,$id_consentimiento,10);
$consentimiento->Actualizar_Consentimiento_firmado_Profesional($id_cita,$id_consentimiento,"false");
$validar_Sin_Firma_Venopuncion=$consentimiento->Validar_Consentimientos_Cita_Firmados_Sin_Firma_Pendiente($id_cita);
$validar_Pendientes=$consentimiento->Validar_Consentimientos_Cita_Pendientes($id_cita);

  }
//}
 
if($validarConsentCita=="0"){
array_map('unlink', array_filter(
(array) array_merge(glob("../firma_paciente_temp/".$ruta_firma))));
$consentimiento->Actualizar_Estado_Cita($id_cita);
$consentimiento->Resetear_Datos_Representante($id_cita);
$_SESSION["aceptRech"] = "";
$_SESSION["selectPro"]="";
}if($validar_Sin_Firma_Venopuncion!="0" && $validar_Pendientes=="0"){
  $consentimiento->Actualizar_Estado_Cita($id_cita);
  $_SESSION["aceptRech"] = "";
  $_SESSION["selectPro"]="";
//$consentimiento->Resetear_Datos_Representante($id_cita);
}
$_SESSION["aceptRech"] = "";
header("location:../ver_consentimientos.php"  . "?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen ."&historial=false&solicitar=false");
      }else if($id_consentimiento == "FT-PA-GI-HC-235"){
        $templateWord = new TemplateProcessor('../formatos/' . $ruta);
        $id_estado="";
        /*header("Refresh: 2; URL=../ver_consentimientos.php?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen ."&historial=false". "&solicitar=true");
        echo '<script>
        Swal.fire({
         icon: "info",
         title: "Se??or Usuario",
         text: "Por favor, proceda a firma el consentimiento, en caso de incapacidad, favor firmar el Representante Legal",
         showConfirmButton: true
         });
        </script>';*/
       //$tipo_documento = $_POST['selecttipodocumento'];
        $nombre = $_POST["nombre_paciente"];
        $apellido = $_POST["apellido_paciente"];
        $documento = $_POST["documento"];
        $eps = $_POST["eps"];
        $edad = $_POST["edad"];
        //$telefono = $_POST["telefono"];
        //$fecha = $_POST["fecha"];
        //$direccion = $_POST["direc"];
        $selectprofesional = $_POST["selectprofesional"];
        $firmaProfesional = $profesional->Consultar_Firma_Profesional($selectprofesional);
        $firmaProfesion = $profesional->Consultar_Datos_Profesional($selectprofesional);
        $acepRech = $_POST["flexRadioDefault"];
      
        if($_POST["flexRadioDefault"] == "S??"){
           $templateWord->setValue('ace',"X");
           $templateWord->setValue('rec',"");
          $id_estado="7";
          $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
          if($datos_repre[0] == "No Aplica"){
            $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
            $templateWord->setValue('cedula_paciente',$documento);
            $templateWord->setValue('si_pac',"X");
            $templateWord->setValue('no_pac',"");
            $templateWord->setValue('si_rec_pac',"");
            $templateWord->setValue('no_rec_pac',"");
           // $templateWord->setValue('firma_representante',"");
          }else{
            $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
            $templateWord->setValue('cedula_paciente',$documento);
            $templateWord->setValue('si_pac',"");
            $templateWord->setValue('no_pac',"");
            $templateWord->setValue('si_rec_pac',"X");
            $templateWord->setValue('no_rec_pac',"");
            }
      }else if($_POST["flexRadioDefault"] =="No"){
          $templateWord->setValue('rec',"X");
          $templateWord->setValue('ace',"");
          $id_estado="8";
            $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));
            if($datos_repre[0] == "No Aplica"){
              $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
              $templateWord->setValue('cedula_paciente',$documento);
              $templateWord->setValue('si_pac',"");
              $templateWord->setValue('no_pac',"X");
              $templateWord->setValue('si_rec_pac',"");
              $templateWord->setValue('no_rec_pac',"");
             // $templateWord->setValue('firma_representante',"");
            }else{
              $templateWord->setImageValue('fima_paciente', array('path' => '../firma_paciente_temp/'.$ruta_firma, 'width' => 200, 'height' => 60, 'ratio' => false));  
              $templateWord->setValue('cedula_paciente',$documento);
              $templateWord->setValue('si_pac',"");
              $templateWord->setValue('no_pac',"");
              $templateWord->setValue('si_rec_pac',"");
              $templateWord->setValue('no_rec_pac',"X");
              }
          }
          $partes = explode("-", $_POST["fecha"]);
          $dia = $partes[2];
          $mes = $partes[1];  
          $anio = $partes[0]; 
          $templateWord->setValue('dia',$dia);
          $templateWord->setValue('mes',$mes);
          $templateWord->setValue('anio',$anio);
      $nombre_completo = $nombre." ".$apellido;
      $templateWord->setValue('nombre',$nombre);
      $templateWord->setValue('apellido',$apellido);
      $templateWord->setValue('nombre_completo',$nombre_completo);
      $templateWord->setValue('documento',$documento);
      $templateWord->setValue('documento2',$documento);
      $templateWord->setValue('eps',$eps);
      $templateWord->setValue('edad',$edad);
      $templateWord->setValue('nombre_pro',$firmaProfesion[1]);
      $templateWord->setValue('ced_pro',$firmaProfesion[0]);
      //$templateWord->setValue('telefono',$telefono);
      //$templateWord->setValue('ciudad',"San Jose De Cucuta");
      $templateWord->setImageValue('fima_profesional', array('path' => '../FirmasProfesionales/' . $firmaProfesional[0], 'width' => 200, 'height' => 60, 'ratio' => false));
      
      $templateWord->saveAs('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
      $archivo_binario = (file_get_contents('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx'));
      
      $consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,$id_estado,$archivo_binario);
        
      $validarConsentCita=$consentimiento->Validar_Consentimientos_Cita_Firmados($id_cita);
      $validar_Sin_Firma_Venopuncion=$consentimiento->Validar_Consentimientos_Cita_Firmados_Sin_Firma_Pendiente($id_cita);
      $validar_Pendientes=$consentimiento->Validar_Consentimientos_Cita_Pendientes($id_cita);
      if($validarConsentCita=="0"){
        array_map('unlink', array_filter(
          (array) array_merge(glob("../firma_paciente_temp/".$ruta_firma))));
      $consentimiento->Actualizar_Estado_Cita($id_cita);
      //$consentimiento->Resetear_Datos_Representante($id_cita);
      $_SESSION["aceptRech"] = "";
      $_SESSION["selectPro"] = "";
      /*$_SESSION["direccion"] = "";
      $_SESSION["telefono"] = "";
      $_SESSION["expedicion"] = "";*/
      
      }if($validar_Sin_Firma_Venopuncion!="0" && $validar_Pendientes=="0"){
        $consentimiento->Actualizar_Estado_Cita($id_cita);
      //$consentimiento->Resetear_Datos_Representante($id_cita);
      $_SESSION["aceptRech"] = "";
      $_SESSION["selectPro"] = "";
      /*$_SESSION["direccion"] = "";
      $_SESSION["telefono"] = "";
      $_SESSION["expedicion"] = "";*/
      }
            //echo $ruta." ".$nombre_paciente." ".$apellido_paciente." ".$tipo_documento." ".$documento." ".$aseguradora." ".$regimen;
            /*echo $nombre_paciente;
            echo $apellido_paciente;*/
            header("location:../ver_consentimientos.php"  . "?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen ."&historial=false&solicitar=false");
            unlink('../archivo_temp/'.$id_cita.'-'.$id_consentimiento.'.docx');
      $_SESSION["aceptRech"] = "";
      $_SESSION["selectPro"] = "";
      /*$_SESSION["direccion"] = "";
      $_SESSION["telefono"] = "";
      $_SESSION["expedicion"] = "";*/
      }
      }
         }
         
    }if(filter_input(INPUT_POST, 'btnConfirmar')){
      $ruta = $consentimiento->Consultar_Archivo_Consentimiento($id_consentimiento);

$templateWord = new TemplateProcessor('../formatos/' . $ruta);
      $nombre_paciente = $_POST['nombre_paciente'];
      $documento = $_POST['documento'];
      $procedimiento = $_POST['procedimiento'];
      $telefono = $_POST['telefono'];
      $selectsexo = $_POST['selectsexo'];
      $cita->Actualizar_Cita_Sexo($id_cita,$selectsexo);
      $edad = $_POST['edad'];
      $peso = $_POST['peso'];
      $talla = $_POST['talla'];
      $flex_alergia = $_POST['flex_alergia'];
      $cual_alergia = $_POST['cual_alergia'];
      $flex_cardiaca = $_POST['flex_cardiaca'];
      $cual_cardiaca = $_POST['cual_cardiaca'];
      $flex_pulmonar = $_POST['flex_pulmonar'];
      $cual_pulmonar = $_POST['cual_pulmonar'];
      $flex_ronquidos = $_POST['flex_ronquidos'];
      $flex_cpap = $_POST['flex_cpap'];
      $flex_oxigeno = $_POST['flex_oxigeno'];
      $flex_psiquiatria = $_POST['flex_psiquiatria'];
      $cual_psiquiatria = $_POST['cual_psiquiatria'];
      $flex_higado = $_POST['flex_higado'];
      $cual_higado = $_POST['cual_higado'];
      $flex_coagulacion = $_POST['flex_coagulacion'];
      $cual_coagulacion = $_POST['cual_coagulacion'];
      $flex_sangrados = $_POST['flex_sangrados'];
      $flex_alcohol = $_POST['flex_alcohol'];
      $flex_embarazo = $_POST['flex_embarazo'];
      $flex_cirugias = $_POST['flex_cirugias'];
      $cual_cirugias = $_POST['cual_cirugias'];
      $flex_sedaciones = $_POST['flex_sedaciones'];
      $cual_sedaciones = $_POST['cual_sedaciones'];
      $flex_fatiga = $_POST['flex_fatiga'];
      $flex_hospitalizacion = $_POST['flex_hospitalizacion'];
      $cual_hospitalizacion = $_POST['cual_hospitalizacion'];
      $flex_procedimiento = $_POST['flex_procedimiento'];
      $medicamento1 = $_POST['medicamento1'];
      $dosis1 = $_POST['dosis1'];
      $medicamento2 = $_POST['medicamento2'];
      $dosis2 = $_POST['dosis2'];
      $medicamento3 = $_POST['medicamento3'];
      $dosis3 = $_POST['dosis3'];
      $medicamento4 = $_POST['medicamento4'];
      $dosis4 = $_POST['dosis4'];
      $medicamento5 = $_POST['medicamento5'];
      $dosis5 = $_POST['dosis5'];

      $templateWord->setValue('nombre_completo',$nombre_paciente);
$templateWord->setValue('documento',$documento);
$templateWord->setValue('examen',$procedimiento);
$templateWord->setValue('telefono',$telefono);
$templateWord->setValue('sexo',$selectsexo);
$templateWord->setValue('edad',$edad);
$templateWord->setValue('peso',$peso);
$templateWord->setValue('talla',$talla);
if($flex_alergia == "SI"){
  $templateWord->setValue('ale_si',"X");
  $templateWord->setValue('ale_no',"");
}else if($flex_alergia =="NO"){
  $templateWord->setValue('ale_no',"X");
  $templateWord->setValue('ale_si',"");
}
$templateWord->setValue('ale_cual',$cual_alergia);
if($flex_cardiaca == "SI"){
  $templateWord->setValue('card_si',"X");
  $templateWord->setValue('card_no',"");
}else if($flex_cardiaca =="NO"){
  $templateWord->setValue('card_no',"X");
  $templateWord->setValue('card_si',"");
}
$templateWord->setValue('card_cual',$cual_cardiaca);
if($flex_pulmonar== "SI"){
  $templateWord->setValue('pul_si',"X");
  $templateWord->setValue('pul_no',"");
}else if($flex_pulmonar =="NO"){
  $templateWord->setValue('pul_no',"X");
  $templateWord->setValue('pul_si',"");
}
$templateWord->setValue('pul_cual',$cual_pulmonar);
if($flex_ronquidos== "SI"){
  $templateWord->setValue('ronq_si',"X");
  $templateWord->setValue('ronq_no',"");
}else if($flex_ronquidos =="NO"){
  $templateWord->setValue('ronq_no',"X");
  $templateWord->setValue('ronq_si',"");
}
if($flex_cpap== "SI"){
  $templateWord->setValue('cpap_si',"X");
  $templateWord->setValue('cpap_no',"");
}else if($flex_cpap =="NO"){
  $templateWord->setValue('cpap_no',"X");
  $templateWord->setValue('cpap_si',"");
}
if($flex_oxigeno== "SI"){
  $templateWord->setValue('oxi_si',"X");
  $templateWord->setValue('oxi_no',"");
}else if($flex_oxigeno =="NO"){
  $templateWord->setValue('oxi_no',"X");
  $templateWord->setValue('oxi_si',"");
}
if($flex_psiquiatria== "SI"){
  $templateWord->setValue('neu_si',"X");
  $templateWord->setValue('neu_no',"");
}else if($flex_psiquiatria =="NO"){
  $templateWord->setValue('neu_no',"X");
  $templateWord->setValue('neu_si',"");
}
$templateWord->setValue('neu_cual',$cual_psiquiatria);
if($flex_higado== "SI"){
  $templateWord->setValue('hig_si',"X");
  $templateWord->setValue('hig_no',"");
}else if($flex_higado =="NO"){
  $templateWord->setValue('hig_no',"X");
  $templateWord->setValue('hig_si',"");
}
$templateWord->setValue('hig_cual',$cual_higado);
if($flex_coagulacion== "SI"){
  $templateWord->setValue('coag_si',"X");
  $templateWord->setValue('coag_no',"");
}else if($flex_coagulacion =="NO"){
  $templateWord->setValue('coag_no',"X");
  $templateWord->setValue('coag_si',"");
}
$templateWord->setValue('coag_cual',$cual_coagulacion);
if($flex_sangrados== "SI"){
  $templateWord->setValue('sang_si',"X");
  $templateWord->setValue('sang_no',"");
}else if($flex_sangrados =="NO"){
  $templateWord->setValue('sang_no',"X");
  $templateWord->setValue('sang_si',"");
}
if($flex_alcohol== "SI"){
  $templateWord->setValue('alc_si',"X");
  $templateWord->setValue('alc_no',"");
}else if($flex_alcohol =="NO"){
  $templateWord->setValue('alc_no',"X");
  $templateWord->setValue('alc_si',"");
}
if($flex_embarazo== "SI"){
  $templateWord->setValue('emb_si',"X");
  $templateWord->setValue('emb_no',"");
}else if($flex_embarazo =="NO"){
  $templateWord->setValue('emb_no',"X");
  $templateWord->setValue('emb_si',"");
}
if($flex_cirugias== "SI"){
  $templateWord->setValue('cir_si',"X");
  $templateWord->setValue('cir_no',"");
}else if($flex_cirugias =="NO"){
  $templateWord->setValue('cir_no',"X");
  $templateWord->setValue('cir_si',"");
}
$templateWord->setValue('cir_cual',$cual_cirugias);
if($flex_sedaciones== "SI"){
  $templateWord->setValue('sed_si',"X");
  $templateWord->setValue('sed_no',"");
}else if($flex_sedaciones =="NO"){
  $templateWord->setValue('sed_no',"X");
  $templateWord->setValue('sed_si',"");
}
$templateWord->setValue('sed_cual',$cual_sedaciones);
if($flex_fatiga== "SI"){
  $templateWord->setValue('fat_si',"X");
  $templateWord->setValue('fat_no',"");
}else if($flex_fatiga =="NO"){
  $templateWord->setValue('fat_no',"X");
  $templateWord->setValue('fat_si',"");
}
if($flex_hospitalizacion== "SI"){
  $templateWord->setValue('hosp_si',"X");
  $templateWord->setValue('hosp_no',"");
}else if($flex_hospitalizacion =="NO"){
  $templateWord->setValue('hosp_no',"X");
  $templateWord->setValue('hosp_si',"");
}
$templateWord->setValue('hosp_cual',$cual_hospitalizacion);
if($flex_procedimiento== "SI"){
  $templateWord->setValue('rec_sed_si',"X");
  $templateWord->setValue('rec_sed_no',"");
  $id_estado="9";
}else if($flex_procedimiento =="NO"){
  $templateWord->setValue('rec_sed_no',"X");
  $templateWord->setValue('rec_sed_si',"");
  $id_estado="9";
}

$templateWord->setValue('medicamento1',$medicamento1);
$templateWord->setValue('dosis1',$dosis1);
$templateWord->setValue('medicamento2',$medicamento2);
$templateWord->setValue('dosis2',$dosis2);
$templateWord->setValue('medicamento3',$medicamento3);
$templateWord->setValue('dosis3',$dosis3);
$templateWord->setValue('medicamento4',$medicamento4);
$templateWord->setValue('dosis4',$dosis4);
$templateWord->setValue('medicamento5',$medicamento5);
$templateWord->setValue('dosis5',$dosis5);
$templateWord->saveAs('../formatos/Plantilla/'. $ruta);
$archivo_binario = (file_get_contents('../formatos/Plantilla/'. $ruta));
$consentimiento->Actualizar_Cita_Consentimiento($id_cita,$id_consentimiento,$id_estado,$archivo_binario);
$validarConsentCita=$consentimiento->Validar_Consentimientos_Cita_Firmados($id_cita);
$validar_Sin_Firma_Venopuncion=$consentimiento->Validar_Consentimientos_Cita_Firmados_Sin_Firma_Pendiente($id_cita);
$validar_Pendientes=$consentimiento->Validar_Consentimientos_Cita_Pendientes($id_cita);
if($validarConsentCita=="0"){
  array_map('unlink', array_filter(
    (array) array_merge(glob("../firma_paciente_temp/".$ruta_firma))));
$consentimiento->Actualizar_Estado_Cita($id_cita);
$consentimiento->Resetear_Datos_Representante($id_cita);
}if($validar_Sin_Firma_Venopuncion!="0" && $validar_Pendientes=="0"){
  $consentimiento->Actualizar_Estado_Cita($id_cita);
//$consentimiento->Resetear_Datos_Representante($id_cita);
}
      header("location:../ver_consentimientos.php"  . "?id_cita=" . $id_cita ."&cod_examen=" . $cod_examen ."&historial=false&solicitar=false");
      unlink('../formatos/Plantilla/'. $ruta);
    }
  
?>