function mostrar2(dato2) {
    if (dato2 == 3 || dato2 == 4) {
      document.getElementById("password").style.display = "block";
    }
    if(dato2 == 1 || dato2 == 2){
      document.getElementById("password").style.display = "none";
    }
  }

  $('.custom-file-input').on('change',function(){
    var fileName = document.getElementById("exampleInputFile").files[0].name;
    $(this).next('.form-control-file').addClass("selected").html(fileName);
  })