<?php
include_once "../classes/BaseDatos.php";
include_once "../classes/campos/CampoTexto.php";
include_once "../classes/campos/CampoNumerico.php";

session_start(); // Inicia la sesión para almacenar el mensaje de error

$bd = BaseDatos::getInstance();

$campoDescripcion = new CampoTexto('', '', '', '', '');
$campoValor = new CampoNumerico('', '', '', '', '');

// Comprueba si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $valor = isset($_POST['valor']) ? (float)$_POST['valor'] : 0;

    //Si el valor tiene , lo cambia por . (para que sea válido)
    $valor = str_replace(",", ".", $valor);

    // Validación básica y con las clases
    if (!empty($tipo) && $campoDescripcion->validarDato($descripcion) && $campoValor->validarDato($valor) && in_array($tipo, ['ingreso', 'gasto'])) {
        $bd = BaseDatos::getInstance();

        // Prepara la consulta para insertar el nuevo movimiento
        $resultado = $bd->sentencia("INSERT INTO movimientos (tipo, descripcion, valor) VALUES (?,?,?)", $tipo, $descripcion, $valor);
        header('Location: ../index.php');
    } else {
        $_SESSION['error'] = "Por favor, rellena los campos correctamente";
        header('Location: ../index.php');
    }

    //Cierro conexión
    $bd->cerrarBD();
}
?>
