window.onload = configurarEntradas;
let costo_estimado = 0;
let choicesInstance;

const ajaxAparatos = () => {
  $.ajax({
    url: "../controllers/dispositivos_controller.php",
    type: "POST",
    data: {},
    dataType: "json",
    success: function (response) {
      costo_estimado = 0;
      $("#aparato").empty();
      $("#costo_estimado").empty();

      let option_select =
        '<option value="0" disabled selected>Seleccione el dispositivo</option>';
      response.forEach((element) => {
        option_select += `<option value="${element[0]}">${element[2]}</option>`;
        costo_estimado += parseFloat(element[3]);
      });

      $("#aparato").append(option_select);
      $("#costo_estimado").append(
        `$${costo_estimado.toLocaleString("en-US")}` + " MXN"
      );

      if (!choicesInstance) {
        choicesInstance = new Choices("#aparato", {
          searchEnabled: false,
          placeholder: true,
          itemSelectText: "",
          noChoicesText: "sin Datos",
          noResultsText: "No hay opciones disponibles",
        });
      }
    },
    error: function (xhr, status, error) {
      console.error("Error en la solicitud AJAX:", error);
      console.log("Respuesta del servidor:", xhr.responseText);
    },
  });
};

ajaxAparatos();

function configurarEntradas() {
  const equipo = document.getElementById("aparato").value;
  console.log(equipo);

  if (equipo > 0) {
    $.ajax({
      url: "../controllers/entradas_dispositivos_controller.php",
      type: "POST",
      data: {
        dispositivo_id: equipo,
      },
      dataType: "json",
      success: function (response) {
        $(".entry").addClass("disabled");
        $(".potencia").empty();
        $(".potencia").append("-");

        response.forEach((element) => {
          $(`#entrada${element[6]}`).removeClass("disabled");
        });
      },
      error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", error);
        console.log("Respuesta del servidor:", xhr.responseText);
      },
    });
  } else {
    $(".entry").addClass("disabled");
    $(".potencia").empty();
    $(".potencia").append("-");
  }
}

function generarPotenciaAleatoria(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function cambiarPotencia() {
  // Comprobar si hay un dispositivo seleccionado
  const equipoSeleccionado = document.getElementById("aparato").value;
  if (equipoSeleccionado === "0" || equipoSeleccionado === "") return;

  const entradas = document.querySelectorAll(".entry:not(.disabled) .potencia");

  entradas.forEach((potenciaDiv, index) => {
    let minPotencia, maxPotencia;

    // Definición de rangos de potencia por entrada habilitada
    switch (index) {
      case 0:
        minPotencia = 10 / 10;
        maxPotencia = 60 / 10;
        break;
      case 1:
        minPotencia = 100 / 10;
        maxPotencia = 300 / 10;
        break;
      case 2:
        minPotencia = 500 / 10;
        maxPotencia = 1500 / 10;
        break;
      case 3:
        minPotencia = 800 / 10;
        maxPotencia = 2000 / 10;
        break;
      case 4:
        minPotencia = 10;
        maxPotencia = 40;
        break;
      case 5:
        minPotencia = 50 / 2;
        maxPotencia = 400 / 10;
        break;
      case 6:
        minPotencia = 200 / 10;
        maxPotencia = 600 / 10;
        break;
      case 7:
        minPotencia = 50 / 10;
        maxPotencia = 500 / 10;
        break;
      default:
        minPotencia = 0;
        maxPotencia = 0;
        break;
    }

    let potenciaBase = generarPotenciaAleatoria(minPotencia, maxPotencia);
    let variacion = Math.floor(potenciaBase * 0.1);
    let potenciaReal =
      potenciaBase + generarPotenciaAleatoria(-variacion, variacion);

    potenciaDiv.innerText = potenciaReal.toLocaleString() + " W";

    let costoTotal;
    if (potenciaReal <= 300) {
      costoTotal = potenciaReal * 0.595;
    } else if (potenciaReal <= 750) {
      costoTotal = 300 * 0.595 + (potenciaReal - 300) * 0.741;
    } else if (potenciaReal <= 900) {
      costoTotal = 300 * 0.595 + 450 * 0.741 + (potenciaReal - 750) * 0.967;
    } else {
      costoTotal =
        300 * 0.595 + 450 * 0.741 + 150 * 0.967 + (potenciaReal - 900) * 1.224;
    }

    costo_estimado += costoTotal / 550;

    $("#costo_estimado").text(
      `$${costo_estimado.toLocaleString("en-US")}` + " MXN"
    );
  });
}

document.getElementById("aparato").addEventListener("change", function (event) {
  event.preventDefault();
});

setInterval(cambiarPotencia, 2500);
cambiarPotencia();
