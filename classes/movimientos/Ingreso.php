<?php
include_once "Movimiento.php";

class Ingreso extends Movimiento {
    public function __construct($id, $descripcion, $valor) {
        parent::__construct($id, "ingreso", $descripcion, $valor);
    }
}

?>