<?php
$presupuesto = new Presupuesto();

if (isset($_POST["id"])) {
  try {
      $presupuesto->eliminarMovimiento($_POST["id"]);
      echo json_encode(["success" => true]);
  } catch (Exception $e) {
      echo json_encode(["error" => $e->getMessage()]);
  }
}
?>
