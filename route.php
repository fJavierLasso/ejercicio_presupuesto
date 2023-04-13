<?php
require_once 'config.php';

require_once CLASSES_PATH . 'BaseDatos.php';
require_once CLASSES_PATH . 'Presupuesto.php';

$bd = BaseDatos::getInstance();
$presupuesto = new Presupuesto($bd);

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'add_movement':
        require 'handlers/add_movement.php';
        break;
    case 'delete_movement':
        require 'handlers/delete_movement.php';
        break;
    case 'movement_api':
        require 'api/movement_api.php';
        break;
    case 'weather_api':
        require 'api/weather_api.php';
        break;
    default:
        // Manejo de errores
        http_response_code(404);
        echo "Error 404: Acción no encontrada";
        break;
}
