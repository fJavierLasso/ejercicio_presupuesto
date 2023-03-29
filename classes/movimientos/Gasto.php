<?php
include_once "Movimiento.php";

class Gasto extends Movimiento {
    public function __construct($id, $descripcion, $valor) {
        parent::__construct($id, "gasto", $descripcion, $valor);
    }

    public function getPorcentaje($totalIngresos) {
        return $totalIngresos > 0 ? round($this->getValor() / $totalIngresos * 100, 2) : 0;
    }
}

?>