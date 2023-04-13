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
                }
            }
        });
    });
});
