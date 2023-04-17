$(document).ready(function () {
     // Llamada AJAX para cargar el clima
     $.ajax({
        type: "GET",
        url: "route.php?action=weather_api",
        dataType: "json",
        success: function (data) {
            // Procesa los datos aquí y genera el contenido HTML
            let weatherContent = `
            
            <p>${data.current.temperature} °C</p>
          `; // , ${data.current.weather_descriptions[0]}</p> denegado por no estar especificado en el plan
             // <h3>${data.location.name}, ${data.location.country}</h3> lo mismo

            // Inserta el contenido HTML en el elemento #weather-container
            $("#weather-container").html(weatherContent);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Mensaje de error si la solicitud falla
            let errorMessage = "Clima no disponible.";

            // Inserta el mensaje de error en el elemento #weather-container
            $("#weather-container").html(`<p>${errorMessage}</p>`);

            // Mostraría el detalle del error en la consola
            console.error(`Error ${textStatus}: ${errorThrown}`);
        },
    });
});
