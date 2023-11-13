

function callModal(msg,address) {
    var myModal = new bootstrap.Modal(document.getElementById('modal-general'), {
      keyboard: false,
    });
    myModal.show();
    document.querySelector('#paragraph').innerHTML = msg;
    
    // Evento para el botón de cerrar el modal y redireccionar
    document.querySelector("#btnClose").addEventListener("click", () => {
      window.location = address;
    });
  }
  
