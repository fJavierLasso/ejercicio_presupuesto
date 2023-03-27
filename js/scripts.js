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

  // Logica ajax para eliminar movimientos. Ahora con jquery :-)
  $('#forma').on('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe de la manera predeterminada

    let tipo = $('#tipo').val();
    let descripcion = $('#descripcion').val();
    let valor = $('#valor').val();

    // Realizar la validación en el lado del cliente aquí si es necesario

    $.ajax({
        type: "POST",
        url: "actions/agregarMovimiento.php",
        data: {
            tipo: tipo,
            descripcion: descripcion,
            valor: valor
        },
        success: function(response) {
            // Si la respuesta es "success", recarga la página o actualiza los datos necesarios
            if (response.trim() === "success") {
                location.reload();
            } else {
                // Si la respuesta no es "success", muestra el mensaje de error
                $('.error').remove();
                $('#forma').before('<p class="error">' + response + '</p>');
            }
        }
    });
});
  