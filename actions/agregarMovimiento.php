<?php
include_once "../config/BaseDatos.php";

$bd = BaseDatos::getInstance();

print_r($_POST);
// Comprueba si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $valor = isset($_POST['valor']) ? (float)$_POST['valor'] : 0;

    // Validación básica
    if (!empty($tipo) && !empty($descripcion) && $valor > 0) {
        $bd = BaseDatos::getInstance();

        // Prepara la consulta para insertar el nuevo movimiento
        $resultado = $bd->sentencia("INSERT INTO movimientos (tipo, descripcion, valor) VALUES (?,?,?)", $tipo, $descripcion, $valor);
        header('Location: ../index.php');
    } else {
        echo "Error al agregar el movimiento";
    }

    //Cierro conexión
    $bd->cerrarBD();
        
} 


?>