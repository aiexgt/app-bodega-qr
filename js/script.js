"use strict";

const registrar = (articulo, to, cantidad) => {
  const usuarioSol = $("#selectSolicitud").val();
  if (usuarioSol == 0) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Usuario solicitante es necesario!",
    });
  } else {
    $.post(
      "./app/add.php",
      {
        articulo,
        to,
        cantidad,
        usuarioSol
      },
      (data, status) => {
        if (data == 1) {
          let timerInterval;
          Swal.fire({
            title: "Registro Exitoso!",
            timer: 750,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
              const b = Swal.getHtmlContainer().querySelector("b");
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft();
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            },
          }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location.href = "dashboard.php";
            }
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ocurrio un error, intenta nuevamente!",
          });
        }
      }
    );
  }
};

const cancelar = () => {
  window.location.href = "dashboard.php";
};
