<?php
abstract class Campo {
    protected $clase;
    protected $placeholder;
    protected $id;
    protected $name;
    protected $titulo;

    public function __construct($clase, $placeholder, $id, $name, $titulo) {
        $this->clase = $clase;
        $this->placeholder = $placeholder;
        $this->id = $id;
        $this->name = $name;
        $this->titulo = $titulo;
    }

    abstract public function validarDato($dato);
    
    abstract public function render();
}
?>