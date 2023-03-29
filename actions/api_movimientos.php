<?php

//Api básica para testear postman
include_once "../classes/BaseDatos.php";

$bd = BaseDatos::getInstance();
$ingresos = $bd->sentencia("SELECT * FROM movimientos WHERE tipo = 'ingreso'")->fetchAll();
$gastos = $bd->sentencia("SELECT * FROM movimientos WHERE tipo = 'gasto'")->fetchAll();

$solicitud = $_GET['solicitud'];

header('Content-Type: application/json');

if ($solicitud == 'ingresos') {
    echo json_encode($ingresos);
} else if ($solicitud == 'gastos') {
    echo json_encode($gastos);
} else {
    echo json_encode([
        'ingresos' => $ingresos,
        'gastos' => $gastos
    ]);
}

die();
