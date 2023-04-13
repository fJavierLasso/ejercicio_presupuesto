<?php
include_once "../classes/Presupuesto.php";

$presupuesto = new Presupuesto();

if (isset($_POST["id"])) {
  $presupuesto->eliminarMovimiento($_POST["id"]);
}
?>
