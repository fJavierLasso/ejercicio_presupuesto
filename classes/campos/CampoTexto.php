<?php
include_once "Campo.php";

class CampoTexto extends Campo {
    public function validarDato($dato) {
        return is_string($dato);
    }

    public function render() {
        return "<input type='text' class='{$this->clase}' placeholder='{$this->placeholder}' id='{$this->id}' name='{$this->name}'>{$this->titulo}</input>";
    }
}
?>
