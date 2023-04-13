<?php
include_once "../classes/Presupuesto.php";

session_start(); // Inicia la sesión para almacenar el mensaje de error
$presupuesto = new Presupuesto();

// Si se ha enviado el formulario...
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Asigno los valores del formulario a variables
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $valor = isset($_POST['valor']) ? (float)$_POST['valor'] : 0;

    // Hago el movimiento
    $presupuesto->agregarMovimiento($tipo, $descripcion, $valor) ? header('Location: ../index.php') : $_SESSION['error'] = "Por favor, rellena los campos correctamente";

    // Me voy a la página principal
    header('Location: ../index.php');
}
