<?php
include_once "../classes/BaseDatos.php";

session_start(); // Inicia la sesión para almacenar el mensaje de error

$bd = BaseDatos::getInstance();

function validarString($valor)
{
    return !empty($valor) && is_string($valor);
}

function validarNumber($valor)
{
    return !empty($valor) && is_numeric($valor) && $valor > 0 && $valor<99999999.99; // El máximo establecido en la tabla de la BD
}

function validarTipo($valor)
{
    return !empty($valor) && in_array($valor, ['ingreso', 'gasto']);
}

// Si se ha enviado el formulario...
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Asigno los valores del formulario a variables
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $valor = isset($_POST['valor']) ? (float)$_POST['valor'] : 0;

    //Si el valor tiene , lo cambia por . (para que sea válido)
    $valor = str_replace(",", ".", $valor);

    // Validación básica de los campos
    if (validarTipo($tipo) && validarString($descripcion) && validarNumber($valor)) {
        $bd = BaseDatos::getInstance();

        // Si todo es válido, inserto el movimiento
        $resultado = $bd->sentencia("INSERT INTO movimientos (tipo, descripcion, valor) VALUES (?,?,?)", $tipo, $descripcion, $valor);

        //Cierro conexión con la BD
        $bd->cerrarBD();

        header('Location: ../index.php');
    } else {
        // Si no es válido, guardo el mensaje de error en la sesión y redirijo al index
        $_SESSION['error'] = "Por favor, rellena los campos correctamente";
        header('Location: ../index.php');
    }
}
