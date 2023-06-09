<?php
class Movimiento {
    private $id;
    private $tipo;
    private $descripcion;
    private $valor;

    public function __construct($id, $tipo, $descripcion, $valor) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->descripcion = $descripcion;
        $this->valor = $valor;
    }

    // getters y setters

    public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getValor() {
        return $this->valor;
    }
}
?>