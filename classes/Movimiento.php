<?php
class Movimiento {
    public $id;
    public $tipo;
    public $descripcion;
    public $valor;

    public function __construct($id, $tipo, $descripcion, $valor) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->descripcion = $descripcion;
        $this->valor = $valor;
    }
}
?>