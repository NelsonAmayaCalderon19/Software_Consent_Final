$(document).ready(function()
  {
    $("#btnConfirmar").click(function () {
        if ($('#validationCustomNombre').val().trim() === '') {
            alert('Debe Ingresar el Nombre del Paciente');
            $("#validationCustomNombre").focus();
            return false;
          }else if ($('#validationCustomApellido').val().trim() === '') {
            alert('Debe Ingresar los Apellido del Paciente');
            $("#validationCustomApellido").focus();
            return false;
          }else if ($('#validationCustomDocumento').val().trim() === '') {
            alert('Debe Ingresar el Numero de Documento del Paciente');
            $("#validationCustomDocumento").focus();
            return false;
          }else if ($('#validationCustomtipoDoc').val().trim() === '') {
            alert('Debe Seleccionar el Tipo de Documento del Paciente');
            $("#validationCustomtipoDoc").focus();
            return false;
          }else if ($('#validationCustomEdad').val().trim() === '') {
            alert('Debe Ingresar la Edad del Paciente');
            $("#validationCustomEdad").focus();
            return false;
          }else if ($('#validationCustomAfiliacion').val().trim() === '') {
            alert('Debe Ingresar la Afiliacion del Paciente');
            $("#validationCustomAfiliacion").focus();
            return false;
          }else if ($('#validationCustomAseguradora').val().trim() === '') {
            alert('Debe Ingresar la Empresa Aseguradora del Paciente');
            $("#validationCustomAseguradora").focus();
            return false;
          }else if ($('#validationCustomRegimen').val().trim() === '') {
            alert('Debe Seleccionar el tipo de Regimen');
            $("#validationCustomRegimen").focus();
            return false;
          }else if ($('#validationCustomSexo').val().trim() === '') {
            alert('Debe Seleccionar el Sexo del Paciente');
            $("#validationCustomSexo").focus();
            return false;
          }else if ($('#validationCustomFecha').val().trim() === '') {
            alert('Debe Seleccionar la Fecha de la Cita');
            $("#validationCustomFecha").focus();
            return false;
          }else if ($('#validationHora').val().trim() === '') {
            alert('Debe Seleccionar la Hora de la Cita');
            $("#validationHora").focus();
            return false;
          }else if ($('#validationCustomEsquema').val().trim() === '') {
            alert('Debe Seleccionar si posee o no Esquema Clinico el Paciente');
            $("#validationCustomEsquema").focus();
            return false;
          }else{
            $("#formularito").submit(); 
          }
    });
});