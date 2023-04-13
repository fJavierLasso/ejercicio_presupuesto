// app.js

// Función para obtener el clima y actualizar el HTML
function getWeather() {
    $.ajax({
        url: 'actions/weather_api.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data !== null) {
                let weatherContainer = $('#weather-container');
                weatherContainer.html(`
                    <h3>Tiempo en ${data.location.name}</h3>
                    <p>Temperatura: ${data.current.temperature}°C</p>
                    <p>Actualmente: ${data.current.weather_descriptions[0]}</p>
                `);
            } else {
                $('#weather-container').html('<p>Error al obtener información del clima.</p>');
            }
        },
        error: function () {
            $('#weather-container').html('<p>Error al obtener información del clima.</p>');
        }
    });
}

// Llamamos a la función al cargar la página
$(document).ready(function () {
    getWeather();
});
