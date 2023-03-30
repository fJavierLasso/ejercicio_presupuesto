//Logica para eliminar movimientos
document.addEventListener("DOMContentLoaded", function () {
  const eliminarBtns = document.querySelectorAll(".elemento_eliminar--btn");

  eliminarBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      const id = btn.dataset.id;
      eliminarMovimiento(id);
    });
  });
});

function eliminarMovimiento(id) {
  $.ajax({
    type: "POST",
    url: "../actions/eliminarMovimiento.php",
    data: {id: id},
    dataType: "html",
    success: function(response) {
      console.log(`Movimiento id ${id} eliminado con éxito`);
      location.reload(); // Recarga la página para mostrar los cambios
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(`Error en la eliminación del movimiento id ${id}: ${textStatus} - ${errorThrown}`);
    }
  });
}


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



