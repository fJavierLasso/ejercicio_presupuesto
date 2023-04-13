<?php
include_once "BaseDatos.php";
include_once "movimientos/Ingreso.php";
include_once "movimientos/Gasto.php";

class Presupuesto
{
    private $movimientos = [];

    public function __construct()
    {
        $bd = BaseDatos::getInstance();
        $resultados = $bd->sentencia("SELECT * FROM movimientos");

        foreach ($resultados as $fila) {
            if ($fila["tipo"] === "ingreso") {
                $this->movimientos[] = new Ingreso($fila["id"], $fila["descripcion"], $fila["valor"]);
            } else if ($fila["tipo"] === "gasto") {
                $this->movimientos[] = new Gasto($fila["id"], $fila["descripcion"], $fila["valor"]);
            } else {
                throw new Exception("Tipo de movimiento desconocido");
            }
        }
    }

    public function getMovimientos()
    {
        return $this->movimientos;
    }

    public function getIngresos()
    {
        return array_filter($this->movimientos, function ($movimiento) {
            return $movimiento->getTipo() === "ingreso";
        });
    }

    public function getGastos()
    {
        return array_filter($this->movimientos, function ($movimiento) {
            return $movimiento->getTipo() === "gasto";
        });
    }

    public function getTotalIngresos()
    {
        return array_reduce($this->getIngresos(), function ($carry, $movimiento) {
            return $carry + $movimiento->getValor();
        }, 0);
    }

    public function getTotalGastos()
    {
        return array_reduce($this->getGastos(), function ($carry, $movimiento) {
            return $carry + $movimiento->getValor();
        }, 0);
    }

    public function agregarMovimiento($tipo, $descripcion, $valor)
    {

        function validarString($valor)
        {
            return !empty($valor) && is_string($valor);
        }

        function validarNumber($valor)
        {
            return !empty($valor) && is_numeric($valor) && $valor > 0 && $valor < 99999999.99; // El máximo establecido en la tabla de la BD
        }

        function validarTipo($valor)
        {
            return !empty($valor) && in_array($valor, ['ingreso', 'gasto']);
        }

        //Si el valor tiene , lo cambia por . (para que sea válido)
        $valor = str_replace(",", ".", $valor);

        // Si todo es válido, inserto el movimiento
        if (validarTipo($tipo) && validarString($descripcion) && validarNumber($valor)) {

            $bd = BaseDatos::getInstance();
            $resultado = $bd->sentencia("INSERT INTO movimientos (tipo, descripcion, valor) VALUES (?,?,?)", $tipo, $descripcion, $valor);
            $bd->cerrarBD();
            return true;

        } else {
            return false;
        }
    }

    public function eliminarMovimiento($id)
    {
        $bd = BaseDatos::getInstance();
        $bd->ejecutar("DELETE FROM movimientos WHERE id = ?", $id);
    }

    public function getPorcentajeGastos()
    {
        return $this->gettotalIngresos() > 0 ? $this->getTotalGastos() / $this->getTotalIngresos() * 100 : 0;
    }

    public function getPresupuestoRestante()
    {
        return $this->getTotalIngresos() - $this->getTotalGastos();
    }
}
