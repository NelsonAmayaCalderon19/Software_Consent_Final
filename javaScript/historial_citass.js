
$(document).ready(function() {
    $("#Date_search").val("");
  });
  
  var table = $('#minhatabela').DataTable( {
    destroy: true,
    deferRender:    true, 
    autoWidth: false,  
    "order": [[ 5, "desc" ]],   
    "search": {
      "regex": false,
      "caseInsensitive": true,
    },language: {
        "sProcessing":     "Procesando...",
                  "sLengthMenu":     "Mostrar _MENU_ registros",
                  "sZeroRecords":    "No se encontraron Resultados",
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
  
  function aviso(url){
          alertify.confirm('<Strong>¡Adventercia!</Strong>',"¿Esta Seguro de Marcar como NO Asistida?",
    function() {     
      alertify.success('Cita No Asistida');   
      document.location = url;
  return true;
  
    },
    function() {      
      alertify.error('Proceso Interrumpido');
    }
  );
  };