<?php
include_once "../config/BaseDatos.php";

if (isset($_POST["id"])) {
  $id = $_POST["id"];
  var_dump($id);
  $bd = BaseDatos::getInstance();

  $resultado = $bd->ejecutar("DELETE FROM movimientos WHERE id = ?", $id);
}
?>
