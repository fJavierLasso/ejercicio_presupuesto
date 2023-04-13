<?php
require_once file_exists('config.php') ? 'config.php' : '../config.php';
require_once CLASSES_PATH . 'Weather.php';

$weather = new Weather();
$city = 'Madrid';
$current_weather = $weather->getCurrentWeather($city);

header('Content-Type: application/json');
echo json_encode($current_weather);

die();
