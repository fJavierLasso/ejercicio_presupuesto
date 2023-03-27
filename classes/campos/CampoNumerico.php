<?php
include_once "Campo.php";

class CampoNumerico extends Campo
{
    private $step;

    public function __construct($clase, $placeholder, $id, $name, $titulo, $step = 'any')
    {
        parent::__construct($clase, $placeholder, $id, $name, $titulo);
        $this->step = $step;
    }

    public function validarDato($dato)
    {
        return is_numeric($dato) && $dato > 0;
    }

    public function render()
    {
        return "<input type='number' class='{$this->clase}' placeholder='{$this->placeholder}' id='{$this->id}' name='{$this->name}' step='{$this->step}'>{$this->titulo}</input>";
    }
}
