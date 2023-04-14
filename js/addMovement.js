$(document).ready(function () {
    // Agregar ingresos y gastos con AJAX
    $("#forma").submit(function (event) {
        event.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "route.php?action=add_movement",
            data: formData,
            dataType: "json",
            success: function (data) {
                if (data.error) {
                    $("#mensajeError").html(`<p class='error'>${data.error}</p>`);
                } else {
                    updateBudget();

                    // Vaciar los campos de descripción y valor
                    $("#descripcion").val("");
                    $("#valor").val("");

                    // Opcional: restablecer el tipo de movimiento a ingreso
                    $(".tipo-option").removeClass("selected");
                    $(".tipo-option[data-tipo='ingreso']").addClass("selected");
                    $("#tipo").val("ingreso");
                }
            }
        });
    });
});
