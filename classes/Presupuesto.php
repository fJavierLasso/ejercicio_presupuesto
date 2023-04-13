<?php
include_once "movimientos/Ingreso.php";
include_once "movimientos/Gasto.php";

class Presupuesto
{
    private $movimientos = [];

    public function __construct($bd)
    {
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
        $ingresos = array_filter($this->movimientos, function ($movimiento) {
            return $movimiento->getTipo() === "ingreso";
        });

        return array_map(function ($ingreso) {
            return [
                'id' => $ingreso->getId(),
                'descripcion' => $ingreso->getDescripcion(),
                'valor' => $ingreso->getValor()
            ];
        }, $ingresos);
    }

    public function getGastos($totalIngresos) // totalIngresos requerido para calcular el porcentaje de cada uno
    {
        $gastos = array_filter($this->movimientos, function ($movimiento) {
            return $movimiento->getTipo() === "gasto";
        });

        return array_map(function ($gasto) use ($totalIngresos) {
            return [
                'id' => $gasto->getId(),
                'descripcion' => $gasto->getDescripcion(),
                'valor' => $gasto->getValor(),
                'porcentaje' => $gasto->getPorcentaje($totalIngresos)
            ];
        }, $gastos);
    }



    public function getTotalIngresos()
    {
        $ingresosArray = $this->getIngresos();
        return array_reduce($ingresosArray, function ($acumulador, $ingreso) {
            return $acumulador + $ingreso['valor'];
        }, 0);
    }

    public function getTotalGastos()
    {
        $gastosArray = $this->getGastos($this->getTotalIngresos());
        return array_reduce($gastosArray, function ($acumulador, $gasto) {
            return $acumulador + $gasto['valor'];
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
        return number_format($this->getTotalIngresos() - $this->getTotalGastos(), 2, '.', '');
    }
}
