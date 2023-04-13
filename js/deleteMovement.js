$(document).ready(function () {
    // Eliminar ingresos y gastos con AJAX
    $(document).on("click", ".elemento_eliminar--btn", function () {
        let id = $(this).data("id");
        let tipo = $(this).closest(".elemento").parent().hasClass("columna-ingresos") ? "ingreso" : "gasto";
        $.ajax({
            type: "POST",
            url: "route.php?action=delete_movement",
            data: { id: id, tipo: tipo },
            dataType: "json",
            success: function (data) {
                if (data.error) {
                    $("#mensajeError").html(`<p class='error'>${data.error}</p>`);
                } else {
                    updateBudget();
                }
            }
        });
    });

    // Logica para el botón de eliminar movimientos
    const eliminarBtns = document.querySelectorAll(".elemento_eliminar--btn");

    eliminarBtns.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const id = btn.dataset.id;
            eliminarMovimiento(id);
        });
    });

    function eliminarMovimiento(id) {
        $.ajax({
            type: "POST",
            url: "../actions/delete_movement.php",
            data: { id: id },
            dataType: "html",
            success: function (response) {
                console.log(`Movimiento id ${id} eliminado con éxito`);
                location.reload(); // Recarga la página para mostrar los cambios
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(`Error en la eliminación del movimiento id ${id}: ${textStatus} - ${errorThrown}`);
            }
        });
    }
});
