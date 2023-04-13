<?php
// Si se ha enviado el formulario...
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asigno los valores del formulario a variables
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $valor = isset($_POST['valor']) ? (float)$_POST['valor'] : 0;

    // Hago el movimiento
    echo $presupuesto->agregarMovimiento($tipo, $descripcion, $valor) ? json_encode(array('success' => true)) : json_encode(array('error' => 'Rellena los campos correctamente.'));
}
