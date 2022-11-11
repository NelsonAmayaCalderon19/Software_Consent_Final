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
                  "sZeroRecords":    "No se encontraron Consentimientos Asociados al Examen",
                  "sEmptyTable":     "Ningún dato disponible en esta tabla :(",
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
                  "sZeroRecords":    "No se encontraron Consentimientos Disponibles",
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

    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('marcarTodo').addEventListener('click', function(e) {
          e.preventDefault();
          seleccionarTodo();
          //checkAll();
      });
  });

    function seleccionarTodo() {
      for (let i=0; i < document.f2.elements.length; i++) {
          if(document.f2.elements[i].type === "checkbox") {
              document.f2.elements[i].checked = true;
          }
      }

  }

  function disableSending(select) {
    // Buscar todos los checkbox con nombre select y que estén marcados
    if($('input[name="check_list[]"]:checked').length > 0) {
        // Al menos hay un checkbox marcado, habilitar botón
        $('#btnAcepta').prop('disabled',false);
    } else {
        // No hay checkbox marcado, deshabilitar botón
        $('#btnAcepta').prop('disabled',true);
    }
}

