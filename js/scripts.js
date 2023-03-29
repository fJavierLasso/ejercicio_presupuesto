//Logica para eliminar movimientos
document.addEventListener("DOMContentLoaded", function () {
  const eliminarBtns = document.querySelectorAll(".elemento_eliminar--btn");

  eliminarBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      const id = e.target.closest(".elemento_eliminar--btn").dataset.id;
      eliminarMovimiento(id);
    });
  });
});

function eliminarMovimiento(id) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../actions/eliminarMovimiento.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(`Movimiento id ${id} eliminado con éxito`);
      location.reload(); // Recarga la página para mostrar los cambios
    }
  };

  xhr.send("id=" + id);
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



