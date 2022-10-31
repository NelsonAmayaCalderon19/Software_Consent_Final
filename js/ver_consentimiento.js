
$(document).ready(function() {
$("#Date_search").val("");
});

var table = $('#minhatabela').DataTable( {
destroy: true,
deferRender:    true, 
autoWidth: false,     
"search": {
  "regex": false,
  "caseInsensitive": true,
},language: {
    "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron Consentimientos",
              "sEmptyTable":     "No Existen Consentimientos Anexados a la Cita Medica :(",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              },
              "buttons": {
                  "copy": "Copiar",
                  "colvis": "Visibilidad"
              },              
},});


var table = $('#minhatabela2').DataTable( {
destroy: true,
deferRender:    true, 
autoWidth: false,     
"search": {
  "regex": false,
  "caseInsensitive": true,
},language: {
    "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron Consentimientos",
              "sEmptyTable":     "No Hay Consentimientos Disponibles :(",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              },
              "buttons": {
                  "copy": "Copiar",
                  "colvis": "Visibilidad"
              },              
},});

var table = $('#minhatabela3').DataTable( {
destroy: true,
deferRender:    true, 
autoWidth: false,     
"search": {
  "regex": false,
  "caseInsensitive": true,
},language: {
    "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron Enfermeros",
              "sEmptyTable":     "No Hay Enfermeros Disponibles :(",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              },
              "buttons": {
                  "copy": "Copiar",
                  "colvis": "Visibilidad"
              },              
},});

$(document).ready(function() {
  $('#select').click(function() {
      $(":checkbox").prop('checked', false);
  })
});

$(document).ready(function() {
  $('#select2').click(function() {
      $(":radio").prop('checked', false);
  })
});
 
 
 
 
 
 var table = $('#minhatabela2');

 if (tabla.firstChild) {
   
   document.getElementById("btnConfirma").setAttribute("disabled","true");
 }else{
   document.getElementById("btnConfirma").setAttribute("disabled","false");
 }
