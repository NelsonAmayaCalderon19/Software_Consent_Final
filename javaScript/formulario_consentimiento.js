
$(document).ready(function() {
          
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
$("#success-alert").slideUp(500);
});
});

$(".custom-select option").each(function() {
$(this).siblings('[value="'+ this.value +'"]').remove();
});

function valideKey(evt){

// code is the decimal ASCII representation of the pressed key.
var code = (evt.which) ? evt.which : evt.keyCode;

if(code==8) { // backspace.
return true;
} else if(code>=48 && code<=57) { // is a number.
return true;
} else{ // other keys.
return false;
}
}

function mostrar(dato) {
  
if (dato == "No") {
//document.getElementById("revocatoria").style.display = "block";
document.getElementById("encabezado_persona_firmante").style.display = "block";
document.getElementById("persona_firmante").style.display = "block";
document.getElementById("firma_paciente").style.display = "none";
document.getElementById("firma_representante").style.display = "none";
//resetRadioButtons("flexRadioFirma");
}
if (dato == "Sí") {
document.getElementById("encabezado_persona_firmante").style.display = "block";
document.getElementById("persona_firmante").style.display = "block";
document.getElementById("revocatoria").style.display = "none";
document.getElementById("firma_paciente").style.display = "none";
document.getElementById("firma_representante").style.display = "none";
resetRadioButtons("flexRadioFirma");
}

}
function mostrar2(dato2) {
if (dato2 == "Paciente") {
document.getElementById("persona_firmante").style.visibility = "visible";
document.getElementById("revocatoria").style.display = "none";
document.getElementById("firma_paciente").style.display = "block";
document.getElementById("firma_representante").style.display = "none";
}
if (dato2 == "Representante_Legal") {
document.getElementById("persona_firmante").style.visibility = "visible";
document.getElementById("revocatoria").style.display = "none";
document.getElementById("firma_paciente").style.display = "none";
document.getElementById("firma_representante").style.display = "block";
}
}

function mostrar3(dato3) {
let alergia = $('input[name="flex_alergia"]:checked').val();
let cardiaca= $('input[name="flex_cardiaca"]:checked').val();
let pulmonar= $('input[name="flex_pulmonar"]:checked').val();
let psiquiatria= $('input[name="flex_psiquiatria"]:checked').val();
let higado= $('input[name="flex_higado"]:checked').val();
let coagulacion= $('input[name="flex_coagulacion"]:checked').val();
let cirugias= $('input[name="flex_cirugias"]:checked').val();
let sedaciones= $('input[name="flex_sedaciones"]:checked').val();
let hospitalizacion= $('input[name="flex_hospitalizacion"]:checked').val();

if (alergia == "SI") {
document.getElementById("cual_alergia").style.visibility = "visible";
}else{document.getElementById("cual_alergia").style.visibility = "hidden";}
if (cardiaca == "SI") {
document.getElementById("cual_cardiaca").style.visibility = "visible";
}else{document.getElementById("cual_cardiaca").style.visibility = "hidden";}
if (pulmonar == "SI") {
document.getElementById("cual_pulmonar").style.visibility = "visible";
}else{document.getElementById("cual_pulmonar").style.visibility = "hidden";}
if (psiquiatria == "SI") {
document.getElementById("cual_psiquiatria").style.visibility = "visible";
}else{document.getElementById("cual_psiquiatria").style.visibility = "hidden";}
if (higado == "SI") {
document.getElementById("cual_higado").style.visibility = "visible";
}else{document.getElementById("cual_higado").style.visibility = "hidden";}
if (coagulacion == "SI") {
document.getElementById("cual_coagulacion").style.visibility = "visible";
}else{document.getElementById("cual_coagulacion").style.visibility = "hidden";}
if (cirugias == "SI") {
document.getElementById("cual_cirugias").style.visibility = "visible";
}else{document.getElementById("cual_cirugias").style.visibility = "hidden";}
if (sedaciones == "SI") {
document.getElementById("cual_sedaciones").style.visibility = "visible";
}else{document.getElementById("cual_sedaciones").style.visibility = "hidden";}
if (hospitalizacion == "SI") {
document.getElementById("cual_hospitalizacion").style.visibility = "visible";
}else{document.getElementById("cual_hospitalizacion").style.visibility = "hidden";}
}

$(document).ready(function()
  {
  $("#btnConfirmar").click(function () {	 
      if( $("#formulario input[name='flex_alergia']:radio").is(':checked') && $("#formulario input[name='flex_cardiaca']:radio").is(':checked') && 
$("#formulario input[name='flex_pulmonar']:radio").is(':checked') && $("#formulario input[name='flex_ronquidos']:radio").is(':checked') &&
$("#formulario input[name='flex_cpap']:radio").is(':checked') && $("#formulario input[name='flex_oxigeno']:radio").is(':checked') &&
$("#formulario input[name='flex_psiquiatria']:radio").is(':checked') && $("#formulario input[name='flex_higado']:radio").is(':checked') &&
$("#formulario input[name='flex_coagulacion']:radio").is(':checked') && $("#formulario input[name='flex_sangrados']:radio").is(':checked') &&
$("#formulario input[name='flex_alcohol']:radio").is(':checked') && $("#formulario input[name='flex_embarazo']:radio").is(':checked') &&
$("#formulario input[name='flex_cirugias']:radio").is(':checked') && $("#formulario input[name='flex_sedaciones']:radio").is(':checked') &&
$("#formulario input[name='flex_fatiga']:radio").is(':checked') && $("#formulario input[name='flex_hospitalizacion']:radio").is(':checked') &&
$("#formulario input[name='flex_procedimiento']:radio").is(':checked')) {  
          
  /*if($("#formulario input[name='flex_alergia']:radio").is(':checked')){
    if($("#formulario input[name='flex_cardiaca']:radio").is(':checked')){
      $("#formulario").submit();
    }*/
    if($("#validationCustomPeso").val().length > 0){
      if($("#validationCustomTalla").val().length > 0){
        
      $("#formulario").submit();  
      }else{
        alert("Recuerde Ingresar la Talla del Paciente"); 
          $("#validationCustomTalla").focus();
        return false;  
      }
        } else{
          
          alert("Recuerde Ingresar el Peso del Paciente"); 
          $("#validationCustomPeso").focus();
        return false;        
        }
  }
   else{  
              alert("Verifique que todas las preguntas hayan sido respondidas, Gracias"); 
    return false; 
              }  
  });
});

$(document).ready(function()
  {
    $("#btnAcepta").click(function () {
      if ($('#validationTipoDocumento').val().trim() === '') {
        alert('Debe seleccionar el Tipo de Documento del Paciente');
        $("#validationTipoDocumento").focus();
        return false;
      }else if($('#validationSexo').val().trim() === ''){
        alert('Debe seleccionar el Sexo del Paciente');
        $("#validationSexo").focus();
        return false;
    }else if(!$("#formularito input[name='flexRadioDefault']:radio").is(':checked')){
      alert("Debe Confirmar si Acepta o No, la Realización del Procedimiento"); 
      return false;
    } else {
      $("#formularito").submit();  
    }
        /*if( $("#formularito input[name='flexRadioDefault']:radio").is(':checked')){      
        $("#formularito").submit();          
        }else{  
                    alert("Debe Confirmar si Acepta o No, la Realización del Procedimiento"); 
          return false; 
                    } */
    });
});

function resetRadioButtons(groupName) {
var arRadioBtn = document.getElementsByName(groupName);

for (var ii = 0; ii < arRadioBtn.length; ii++) {
  var radButton = arRadioBtn[ii];
  radButton.checked = false;
}
}