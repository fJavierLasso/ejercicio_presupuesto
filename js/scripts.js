
document.addEventListener("DOMContentLoaded", function () {
    const eliminarBtns = document.querySelectorAll(".elemento_eliminar--btn");
  
    eliminarBtns.forEach((btn) => {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        const id = e.target.closest(".elemento_eliminar--btn").dataset.id;
        eliminarMovimiento(id);
      });
    });
  });
  
function eliminarMovimiento(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../actions/eliminarMovimiento.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(`Movimiento id ${id} eliminado con éxito`);
        location.reload(); // Recarga la página para mostrar los cambios
      }
    };
  
    xhr.send("id=" + id);
  }
  