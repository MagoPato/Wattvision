const entradas = document.querySelectorAll(".entry");

    entradas.forEach((entrada, index) => {
      const potenciaDiv = entrada.querySelector(".potencia");
      if (equipo === "0") {
        entrada.classList.add("disabled");
        potenciaDiv.innerHTML = "-"; // Mostrar "-" si está deshabilitada
      } else if (
        (equipo === "1" && index < 4) ||
        (equipo === "2" && index < 6) ||
        equipo === "3"
      ) {
        entrada.classList.remove("disabled");
        potenciaDiv.innerHTML = "0w"; // Mostrar "0w" si está habilitada
      } else {
        entrada.classList.add("disabled");
        potenciaDiv.innerHTML = "-"; // Mostrar "-" si está deshabilitada
      }
    });




    document.addEventListener("DOMContentLoaded", function () {
      const choices = new Choices("#aparato", {
        searchEnabled: false, // Desactiva la búsqueda si no es necesaria
        placeholder: true,
        placeholderValue: "Seleccione el dispositivo",
        itemSelectText: "",
      });
    });