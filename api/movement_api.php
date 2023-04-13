<?php
$presupuesto = new Presupuesto();
$bd = BaseDatos::getInstance();

$ingresos = array_values($presupuesto->getIngresos());
$gastos = array_values($presupuesto->getGastos($presupuesto->getTotalIngresos()));

if (!isset($_GET['request'])) {
    echo json_encode(['error' => 'Parámetro no válido']);
    die();
}

$request = $_GET['request'];
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
