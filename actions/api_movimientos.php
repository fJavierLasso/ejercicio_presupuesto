<?php

//Api básica para testear postman
include_once "../classes/BaseDatos.php";

$bd = BaseDatos::getInstance();
$ingresos = $bd->sentencia("SELECT * FROM movimientos WHERE tipo = 'ingreso'")->fetchAll();
$gastos = $bd->sentencia("SELECT * FROM movimientos WHERE tipo = 'gasto'")->fetchAll();

$solicitud = $_GET['solicitud'];
$solicitudRecuperada = $bd->sentencia("SELECT * FROM movimientos WHERE id = '$solicitud'")->fetchAll();

header('Content-Type: application/json');

if ($solicitud == 'ingresos') {
    echo json_encode($ingresos);
} else if ($solicitud == 'gastos') {
    echo json_encode($gastos);
} else {
    if ($solicitudRecuperada) {
        echo json_encode($solicitudRecuperada);
    } else {
        echo json_encode(['error' => 'Parámetro no válido']);
    }
}

die();
