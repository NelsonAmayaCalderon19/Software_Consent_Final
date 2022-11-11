
      var table = $('#minhatabela3').DataTable( {
        destroy: true,
        "order": [[ 1, "asc" ]],
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