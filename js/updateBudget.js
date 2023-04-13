// Función para actualizar la lista de ingresos y gastos
function updateBudget() {

    $("#mensajeError").html(""); // Limpiar el mensaje de error

    $.getJSON("route.php?action=movement_api&request=budget", function (data) {
        $("#presupuesto").html(data.presupuesto_restante + "€");
        $("#ingresos").html(data.total_ingresos + "€");
        $("#egresos").html("- " + data.total_gastos + "€");
        $("#porcentaje").html(data.porcentaje_gastos + "%");

        let ingresosHtml = "";
        let gastosHtml = "";

        data.ingresos.forEach((ingreso) => {
            ingresosHtml += `
        <div class="elemento limpiarEstilos">
            <div class="elemento_descripcion">${ingreso.descripcion}</div>
            <div class="derecha limpiarEstilos">
                <div class="elemento_valor">${ingreso.valor}€</div>
                <div class="elemento_eliminar">
                    <button class='elemento_eliminar--btn' data-id="${ingreso.id}">
                        <img class="eliminar" src="imgs/delete.png" alt="">
                    </button>
                </div>
            </div>
        </div>`;
        });

        data.gastos.forEach((gasto) => {
            gastosHtml += `
        <div class="elemento limpiarEstilos">
            <div class="elemento_descripcion">${gasto.descripcion}</div>
            <div class="derecha limpiarEstilos">
                <div class="elemento_valor">${gasto.valor}€</div>
                <div class="elemento_porcentaje">${gasto.porcentaje}%</div>
                <div class="elemento_eliminar">
                    <button class='elemento_eliminar--btn' data-id="${gasto.id}">
                        <img class="eliminar" src="imgs/delete.png" alt="">
                    </button>
                </div>
            </div>
        </div>`;
        });

        $("#lista-ingresos").html(ingresosHtml);
        $("#lista-gastos").html(gastosHtml);
    });
}


$(document).ready(function () {
    // Llamada inicial para cargar el presupuesto, ingresos y gastos
    updateBudget();

});
