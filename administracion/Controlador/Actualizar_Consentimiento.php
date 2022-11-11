<?php
session_start();
if (!isset($_SESSION["usuario"])) {
  header("location:../index.php");
}
?>
<?php
include_once '../../Conexion/Conexion.php'; 
require '../../modelo/Consentimiento.php';
include_once '../../modelDao/ConsentimientoDao.php';
include_once '../../javaScript/script_sweet.js';
require_once dirname(__FILE__).'/PHPWord-develop/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
use PhpOffice\PhpWord\Element\AbstractContainer;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;

if(filter_input(INPUT_POST, 'btnAcepta')){

$miSelectFirmante = $_POST['selectfirmante'];
$miSelectalternativas = $_POST['selectalternativas'];
$templateWord = new TemplateProcessor('../../formatos/Plantilla/plantilla2.docx');
$consentimiento= new ConsentimientoDao();
$codigo = $_POST["codigo_consentimiento"];
$descripcion = "FORMATO DE CONSENTIMIENTO INFORMADO DE " . $_POST["nombre_procedimiento"];
$ruta_archivo = $codigo . " " . $descripcion . ".docx";
try{
$consentimiento->Eliminar_Consent_Examen($codigo);
}catch(PDOException $e){
}

if(!empty($_POST['check_list'])){
  foreach($_POST['check_list'] as $selected){
        try{
 $consentimiento -> Guardar_Consentimiento_Examen($selected,$codigo);
}catch(PDOException $e){
  echo $e;
}

}  
}
/*$nombre = $_POST['nombre_procedimiento'];
$objetivo = $_POST['objetivo'];
$descripcion = $_POST['descripcion'];

$beneficios = $_POST['beneficios'];
$riesgos = $_POST['riesgos'];
$alternativas = $_POST['alternativas'];
if($miSelectalternativas=="Si"){
    $templateWord->setValue('si',"X");
    $templateWord->setValue('no',"");
}else{
    $templateWord->setValue('no',"X");
    $templateWord->setValue('si',"");
}
$decision = $_POST['decision'];
$revocatoria = $_POST['revocatoria'];
$templateWord->setValue('nombre',$nombre);
$templateWord->setValue('objetivo',$objetivo);
$templateWord->setValue('descripcion',$descripcion);
$templateWord->setValue('beneficios',$beneficios);
$templateWord->setValue('riesgos',$riesgos);
$templateWord->setValue('alternativas',$alternativas);
$templateWord->setValue('decisión',$decision);
$templateWord->setValue('inquietud',"");
$templateWord->setValue('respuesta',"");
$templateWord->setValue('revocatoria',$revocatoria);
$templateWord->setValue('profesional',$miSelectFirmante);
//$templateWord->saveAs('../../formatos/'. $ruta_archivo);
$consentimiento -> Actualizar_Consentimiento_Detalle($codigo,$nombre,$descripcion,$objetivo,$beneficios,$riesgos,$miSelectalternativas,$alternativas,$decision,$revocatoria,$miSelectFirmante);

*/
$nombre = $_POST['nombre_procedimiento'];
$objetivo = $_POST['objetivo'];
$reemp_obj = nl2br(htmlentities($objetivo));
$texto_obj = new TextRun();
Html::addHtml($texto_obj, $reemp_obj);
$descripcion = $_POST['descripcion'];
$reemp_desc = nl2br(htmlentities($descripcion));
$texto_desc = new TextRun();
Html::addHtml($texto_desc, $reemp_desc);
$beneficios = $_POST['beneficios'];
$reemp_ben = nl2br(htmlentities($beneficios));
$texto_ben = new TextRun();
Html::addHtml($texto_ben, $reemp_ben);
$riesgos = $_POST['riesgos'];
$reemp_ries = nl2br(htmlentities($riesgos));
$texto_ries = new TextRun();
Html::addHtml($texto_ries, $reemp_ries);
$alternativas = $_POST['alternativas'];
$reemp_alt = nl2br(htmlentities($alternativas));
$texto_alt = new TextRun();
Html::addHtml($texto_alt, $reemp_alt);
if($miSelectalternativas=="Si"){
    $templateWord->setValue('si',"X");
    $templateWord->setValue('no',"");
}else{
    $templateWord->setValue('no',"X");
    $templateWord->setValue('si',"");
}
$decision = $_POST['decision'];
$reemp_dec = nl2br(htmlentities($decision));
$texto_dec = new TextRun();
Html::addHtml($texto_dec, $reemp_dec);
$revocatoria = $_POST['revocatoria'];
$reemp_rev = nl2br(htmlentities($revocatoria));
$texto_rev = new TextRun();
Html::addHtml($texto_rev, $reemp_rev);
$templateWord->setValue('nombre',$nombre);
$templateWord->setComplexValue('objetivo',$texto_obj);
$templateWord->setComplexValue('descripcion',$texto_desc);
$templateWord->setComplexValue('beneficios',$texto_ben);
$templateWord->setComplexValue('riesgos',$texto_ries);
$templateWord->setComplexValue('alternativas',$texto_alt);
$templateWord->setComplexValue('decisión',$texto_dec);
$templateWord->setValue('inquietud',"");
$templateWord->setValue('respuesta',"");
$templateWord->setComplexValue('revocatoria',$texto_rev);
$templateWord->setValue('profesional',$miSelectFirmante);
$templateWord->saveAs('../../formatos/'. $ruta_archivo);
$consentimiento -> Actualizar_Consentimiento_Detalle($codigo,$nombre,$descripcion,$objetivo,$beneficios,$riesgos,$miSelectalternativas,$alternativas,$decision,$revocatoria,$miSelectFirmante);

if($consentimiento){
          
  header("Refresh: 1; URL=../panel_admin.php");
  echo '<script>
  Swal.fire({
   icon: "success",
   title: "Proceso Exitoso",
   text: "Consentimiento Actualizado Satisfactoriamente",
   showConfirmButton:false,
   });
  </script>';
      }else{
      echo "No se Inserto";
      }
      
}
?>
