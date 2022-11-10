
    function mostrar(){

      var valorCambiado =$('#validationCustomSelect').val();
      if((valorCambiado == '3')||(valorCambiado == '4')){
         $('#user').css('display','block');
         $('#prof').css('display','none');
       }
       else if(valorCambiado == '2' || valorCambiado == '1')
       {
        $('#user').css('display','none');
         $('#prof').css('display','block');
       }
      }
  
    
    $(".custom-select option").each(function() {
      $(this).siblings('[value="'+ this.value +'"]').remove();
    });
 
    $('.custom-file-input').on('change',function(){
    var fileName = document.getElementById("exampleInputFile").files[0].name;
    $(this).next('.form-control-file').addClass("selected").html(fileName);
  })
