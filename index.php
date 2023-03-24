<?php
include_once "config/BaseDatos.php";

$bd = BaseDatos::getInstance();

$movimientos = $bd->sentencia("SELECT * FROM movimientos");
$totalIngresos = $bd->sentencia("SELECT SUM(valor) FROM movimientos WHERE tipo = 'ingreso'")->fetchColumn();
$totalGastos = $bd->sentencia("SELECT SUM(valor) FROM movimientos WHERE tipo = 'gasto'")->fetchColumn();

//para evitar división entre 0
$porcentajeGastos= $totalIngresos>0 ? round($totalGastos/$totalIngresos *100,0) : 0;
$presupuesto = $totalIngresos - $totalGastos;

$gastos = $bd->sentencia("SELECT * FROM movimientos WHERE tipo = 'gasto'");
$ingresos = $bd->sentencia("SELECT * FROM movimientos WHERE tipo = 'ingreso'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Presupuesto</title>

    <link href="css/estilos.css" rel='stylesheet' />
    <script src="js/scripts.js" defer></script>

</head>

<body>
    <div class="cabecero">
        <div class="presupuesto">
            <div class="presupuesto_titulo">
                Presupuesto Disponible
            </div>
            <div class="presupuesto_valor" id='presupuesto'><?php echo $presupuesto; ?>€</div>
            <div class="presupuesto_ingreso limpiarEstilos">
                <div class="presupuesto_ingreso--texto">Ingresos</div>
                <div class="derecha">
                    <div class="presupuesto_ingreso--valor" id='ingresos'><?php echo $totalIngresos; ?>€</div>
                    <div class="presupuesto_ingreso--porcentaje">&nbsp;</div>
                </div>
            </div>
            <div class="presupuesto_egreso limpiarEstilos">
                <div class="presupuesto_egreso--texto">Gastos</div>
                <div class="derecha limpiarEstilos">
                    <div class="presupuesto_egreso--valor" id='egresos'>- <?php echo $totalGastos ?>€</div>
                    <div class="presupuesto_egreso--porcentaje" id='porcentaje'><?php echo $porcentajeGastos ?>%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- intro de datos -->

    <form id='forma' method="POST" action="actions/agregarMovimiento.php">
        <div class="agregar">
            <div class="agregar_contenedor">
                <select class='agregar_tipo' id='tipo' name="tipo">
                    <option value='ingreso' selected>+</option>
                    <option value='gasto'>-</option>
                </select>
                <input type='text' class='agregar_descripcion' placeholder="Agregar Descripción" id='descripcion' name="descripcion" />
                <input type='number' class='agregar_valor' placeholder="Valor" id='valor' step='any' name="valor" />
                <button type="submit" class='agregar_btn'">
                <img class="crear" src="imgs/checkmark.png" alt="">
                </button>
            </div>
        </div>
    </form>


    <!-- lista de ingresos -->
    <div class="contenedor limpiarEstilos">
        <div class="columna-ingresos">
            <h2 class='ingreso_titulo'>Ingresos</h2>
            <hr>
            <?php
            foreach ($ingresos as $movimiento) {
            ?>
                    <div class="elemento limpiarEstilos">
                        <div class="elemento_descripcion"><?php echo $movimiento['descripcion']; ?></div>
                        <div class="derecha limpiarEstilos">
                            <div class="elemento_valor"><?php echo $movimiento['valor']; ?>€</div>
                            <div class="elemento_eliminar">
                            <button class='elemento_eliminar--btn' data-id="<?php echo $movimiento['id']; ?>">
                            <img class="eliminar" src="imgs/delete.png" alt="">
                            </button>
                            </div>
                        </div>
                    </div>
            <?php
            }
            ?>
        </div>
            
        <!-- lista de gastos -->
        <div class="columna-gastos">
            <h2 class='egreso_titulo'>Gastos</h2>
            <hr>
            <?php
            foreach ($gastos as $movimiento) {
            ?>
                    <div class="elemento limpiarEstilos">
                        <div class="elemento_descripcion"><?php echo $movimiento['descripcion']; ?></div>
                        <div class="derecha limpiarEstilos">
                            <div class="elemento_valor"><?php echo $movimiento['valor']; ?>€</div>
                            <div class="elemento_porcentaje"><?php echo round($movimiento['valor']/$totalIngresos*100,2) ?>%</div>
                            <div class="elemento_eliminar">
                            <button class='elemento_eliminar--btn' data-id="<?php echo $movimiento['id']; ?>">
                            <img class="eliminar" src="imgs/delete.png" alt="">
                            </button>
                            </div>
                        </div>
                    </div>
            <?php
            }
            ?>
            
        </div>
    </div>
</body>

</html>
