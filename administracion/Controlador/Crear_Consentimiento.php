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
require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
//use PhpOffice\PhpWord\IOFactory;
//use PhpOffice\PhpWord\Settings;
//require('fpdf/fpdf.php');
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;
//$pdf = new FPDF();
if(filter_input(INPUT_POST, 'btnAcepta')){
$miSelectExamen = $_POST['selectexamen'];
$miSelectFirmante = $_POST['selectfirmante'];
$miSelectalternativas = $_POST['selectalternativas'];
$templateWord = new TemplateProcessor('../../formatos/Plantilla/plantilla2.docx');
$consentimiento= new ConsentimientoDao();
$codigo = $_POST["codigo_consentimiento"];
$descripcion = "FORMATO DE CONSENTIMIENTO INFORMADO DE " . $_POST["nombre_procedimiento"];
$ruta_archivo = $codigo . " " . $descripcion . ".docx";
$consentimiento -> Guardar_Consentimiento($codigo,$descripcion,$ruta_archivo);
for ($i=0;$i<count($miSelectExamen);$i++)    
{
$consentimiento -> Guardar_Consentimiento_Examen($miSelectExamen[$i],$codigo);
}
$nombre = $_POST['nombre_procedimiento'];
$objetivo = $_POST['objetivo'];
$descripcion = $_POST['descripcion'];
//$reemp = str_replace("\r\n", "</br>", $_POST['beneficios']);
//$beneficios =  json_encode($reemp);
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
$templateWord->saveAs('../../formatos/'. $ruta_archivo);
$consentimiento -> Guardar_Consentimiento_Detalle($codigo,$nombre,$descripcion,$objetivo,$beneficios,$riesgos,$miSelectalternativas,$alternativas,$decision,$revocatoria,$miSelectFirmante);
header("location:../panel_admin.php");

}
?>
