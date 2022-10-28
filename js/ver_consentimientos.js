function editar(este) {
    var ModalEdit = new bootstrap.Modal(exampleModal2, {}).show();
    document.forms['formElement2'].action = "Controlador/Crear_Consentimiento.php?id_cita=<?php echo $id_cita?>&cod_consentimiento="+este+"&cod_examen=<?php echo $cod_examen?>";
  }

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

   var idCanvas='canvas';
   var idForm='formCanvas';
   var inputImagen='imagen';
   var estiloDelCursor='crosshair';
   var colorDelTrazo='#555';
   var colorDeFondo='#fff';
   var grosorDelTrazo=2;

   /* Variables necesarias */
   var contexto=null;
   var valX=0;
   var valY=0;
   var flag=false;
   var imagen=document.getElementById(inputImagen); 
   var anchoCanvas=document.getElementById(idCanvas).offsetWidth;
   var altoCanvas=document.getElementById(idCanvas).offsetHeight;
   var pizarraCanvas=document.getElementById(idCanvas);

   /* Esperamos el evento load */
   window.addEventListener('load',IniciarDibujo,false);

   function IniciarDibujo(){
     /* Creamos la pizarra */
     pizarraCanvas.style.cursor=estiloDelCursor;
     contexto=pizarraCanvas.getContext('2d');
     contexto.fillStyle=colorDeFondo;
     contexto.fillRect(0,0,anchoCanvas,altoCanvas);
     contexto.strokeStyle=colorDelTrazo;
     contexto.lineWidth=grosorDelTrazo;
     contexto.lineJoin='round';
     contexto.lineCap='round';
     /* Capturamos los diferentes eventos */
     pizarraCanvas.addEventListener('mousedown',MouseDown,false);// Click pc
     pizarraCanvas.addEventListener('mouseup',MouseUp,false);// fin click pc
     pizarraCanvas.addEventListener('mousemove',MouseMove,false);// arrastrar pc

     pizarraCanvas.addEventListener('touchstart',TouchStart,false);// tocar pantalla tactil
     pizarraCanvas.addEventListener('touchmove',TouchMove,false);// arrastras pantalla tactil
     pizarraCanvas.addEventListener('touchend',TouchEnd,false);// fin tocar pantalla dentro de la pizarra
     pizarraCanvas.addEventListener('touchleave',TouchEnd,false);// fin tocar pantalla fuera de la pizarra
   }

   function MouseDown(e){
     flag=true;
     contexto.beginPath();
     valX=e.pageX-posicionX(pizarraCanvas); valY=e.pageY-posicionY(pizarraCanvas);
     contexto.moveTo(valX,valY);
   }

   function MouseUp(e){
     contexto.closePath();
     flag=false;
   }

   function MouseMove(e){
     if(flag){
       contexto.beginPath();
       contexto.moveTo(valX,valY);
       valX=e.pageX-posicionX(pizarraCanvas); valY=e.pageY-posicionY(pizarraCanvas);
       contexto.lineTo(valX,valY);
       contexto.closePath();
       contexto.stroke();
     }
   }

   function TouchMove(e){
     e.preventDefault();
     if (e.targetTouches.length == 1) { 
       var touch = e.targetTouches[0]; 
       MouseMove(touch);
     }
   }

   function TouchStart(e){
     if (e.targetTouches.length == 1) { 
       var touch = e.targetTouches[0]; 
       MouseDown(touch);
     }
   }

   function TouchEnd(e){
     if (e.targetTouches.length == 1) { 
       var touch = e.targetTouches[0]; 
       MouseUp(touch);
     }
   }

   function posicionY(obj) {
     var valor = obj.offsetTop;
     if (obj.offsetParent) valor += posicionY(obj.offsetParent);
     return valor;
   }

   function posicionX(obj) {
     var valor = obj.offsetLeft;
     if (obj.offsetParent) valor += posicionX(obj.offsetParent);
     return valor;
   }

   /* Limpiar pizarra */
   function LimpiarTrazado(){
     contexto=document.getElementById(idCanvas).getContext('2d');
     contexto.fillStyle=colorDeFondo;
     contexto.fillRect(0,0,anchoCanvas,altoCanvas);
   }

   /* Enviar el trazado */
   function GuardarTrazado(){
     imagen.value=document.getElementById(idCanvas).toDataURL('image/png');
     document.forms[idForm].submit();
   }

$(document).ready(function() {
         
         $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
     $("#success-alert").slideUp(500);
   });
     });

     function mostrar(dato) {
       
 if (dato == "Representante Legal") {
   document.getElementById("firma_representante").style.display = "block";
 }else if(dato == "Paciente"){
   document.getElementById("firma_representante").style.display = "none";
 }
}