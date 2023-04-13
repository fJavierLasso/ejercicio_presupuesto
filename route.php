<?php

require_once 'classes/BaseDatos.php';
require_once 'classes/Presupuesto.php';
require_once 'classes/Weather.php';

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'add_movement':
        require 'actions/add_movement.php';
        break;
    case 'delete_movement':
        require 'actions/delete_movement.php';
        break;
    case 'movement_api':
        require 'api/movement_api.php';
        break;
    case 'weather_api':
        require 'api/weather_api.php';
        break;
    default:
        // Aquí puedes manejar casos no válidos o desconocidos, por ejemplo:
        http_response_code(404);
        echo "Error 404: Acción no encontrada";
        break;
}
