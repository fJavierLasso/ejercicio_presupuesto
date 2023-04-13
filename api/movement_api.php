<?php
require_once file_exists('config.php') ? 'config.php' : '../config.php';
require_once CLASSES_PATH . 'BaseDatos.php';
require_once CLASSES_PATH . 'Presupuesto.php';

$bd = BaseDatos::getInstance();
$presupuesto = new Presupuesto($bd);

$ingresos = array_values($presupuesto->getIngresos());
$gastos = array_values($presupuesto->getGastos($presupuesto->getTotalIngresos()));

// Si no se ha enviado el parámetro request, devuelve un error
if (!isset($_GET['request'])) {
    echo json_encode(['error' => 'Parámetro no válido']);
    die();
}

$request = $_GET['request'];

// Si se ha enviado el parámetro request con un id, devuelve el movimiento con ese id
$requestRecuperada = $bd->sentencia("SELECT * FROM movimientos WHERE id = '$request'")->fetchAll();

header('Content-Type: application/json');

if ($request == 'budget') {
    $presupuesto_data = [
        "presupuesto_restante" => $presupuesto->getPresupuestoRestante(),
        "total_ingresos" => $presupuesto->getTotalIngresos(),
        "total_gastos" => $presupuesto->getTotalGastos(),
        "porcentaje_gastos" => round($presupuesto->getPorcentajeGastos(), 2),
        "ingresos" => $ingresos,
        "gastos" => $gastos
    ];
    

    echo json_encode($presupuesto_data);

} elseif ($request == 'income') {

    echo json_encode($ingresos);

} else if ($request == 'outcome') {

    echo json_encode($gastos);

} else {

    if ($requestRecuperada) {
        echo json_encode($requestRecuperada);
    } else {
        echo json_encode(['error' => 'Invalid parameter']);
    }
}

die();
