$(".custom-select option").each(function() {
    $(this).siblings('[value="'+ this.value +'"]').remove();
  });