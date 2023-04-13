// Animaciones del selector gasto/ingreso
$(document).ready(function () {
    $(".tipo-option").on("click", function () {
      $(".tipo-option.selected").removeClass("selected");
      $(this).addClass("selected");
      $("#tipo").val($(this).data("tipo"));
    });
  });
  
  // Animaciones del botón de enviar
  $(document).ready(function () {
    $(".agregar_btn").on("mousedown", function () {
      $(this).addClass("clicked");
    });
  
    $(".agregar_btn").on("mouseup", function () {
      $(this).removeClass("clicked");
    });
  
    // Asegurarse de que el botón vuelva a su tamaño original si el mouse sale del botón mientras está presionado
    $(".agregar_btn").on("mouseleave", function () {
      $(this).removeClass("clicked");
    });
  });