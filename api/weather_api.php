<?php
// weather_api.php

$weather = new Weather();
$city = 'Madrid';
$current_weather = $weather->getCurrentWeather($city);

header('Content-Type: application/json');
echo json_encode($current_weather);
