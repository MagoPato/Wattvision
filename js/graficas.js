document.addEventListener("DOMContentLoaded", function () {
  const choices = new Choices("#yearSelect", {
    searchEnabled: false, // Desactiva la búsqueda si no es necesaria
    placeholder: true, //
    placeholderValue: "Año",
    itemSelectText: "",
    noChoicesText: "Sin Datos",
    noResultsText: "No hay opciones disponibles",
  });
});

var ctx1 = document.getElementById("chart1").getContext("2d");

// Labels fijos
const labels = [
  "12AM",
  "2AM",
  "4AM",
  "6AM",
  "8AM",
  "10AM",
  "12PM",
  "2PM",
  "4PM",
  "6PM",
  "8PM",
  "10PM",
  "12AM",
];

var chart1 = new Chart(ctx1, {
  type: "line",
  data: {
    labels: labels, // Etiquetas fijas
    datasets: [
      {
        label: "Consumo Eléctrico en Tiempo Real",
        data: new Array(labels.length).fill(null), // Inicialmente llena con null
        backgroundColor: "rgba(40, 167, 69, 0.6)",
        borderColor: "#28A745",
        borderWidth: 2,
        fill: false, // No llenar el área bajo la línea
        pointBackgroundColor: "#ffffff", // Puntos en blanco
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
        labels: {
          color: "#333",
          font: {
            size: 15,
          },
        },
      },
      tooltip: {
        backgroundColor: "rgba(40, 167, 69, 0.8)",
        titleColor: "#fff",
        bodyColor: "#fff",
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: "Consumo (kWh)",
        },
      },
      x: {
        grid: {
          display: false,
        },
        title: {
          display: true,
          text: "Tiempo",
        },
      },
    },
  },
});

// Índice de datos
let dataPointIndex = 0;

// Función para calcular el costo basado en el consumo
function calcularCosto(consumo) {
  let costo = 0;

  if (consumo <= 150) {
    costo = consumo * 0.711;
  } else if (consumo <= 300) {
    costo = 150 * 0.711 + (consumo - 150) * 0.839;
  } else if (consumo <= 450) {
    costo = 150 * 0.711 + 150 * 0.839 + (consumo - 300) * 1.071;
  } else if (consumo <= 500) {
    costo = 150 * 0.711 + 150 * 0.839 + 150 * 1.071 + (consumo - 450) * 2.859;
  } else {
    costo =
      150 * 0.711 +
      150 * 0.839 +
      150 * 1.071 +
      50 * 2.859 +
      (consumo - 500) * 6.38; // Agregar IVA si es necesario
  }

  return costo;
}

// Función para calcular el consumo de energía en kWh
function generarConsumoKWh() {
  const climaPorCuarto = 1; // Un aire acondicionado por cuarto
  const climaEnSala = 1; // Un aire acondicionado en la sala
  const consumoPorHoraPorClima = 1.5; // Consumo en kWh por hora por aire acondicionado
  const consumoPorHoraRefrigerador = 1; // Consumo en kWh por hora del refrigerador
  const consumoPorHoraLuces = 0.5; // Consumo en kWh por hora de luces

  const horasUsoRefrigerador = 24; // Refrigerador siempre está en uso
  const horasUsoLuces = 5; // Horas promedio que se usan las luces

  // Generar una temperatura aleatoria entre 20 y 40 grados Celsius
  const temperatura = Math.floor(Math.random() * 21) + 20; // Rango de 20 a 40

  // Determinar las horas de uso de los aires acondicionados basado en la temperatura
  let horasUsoClimaCuarto = 0;
  let horasUsoClimaSala = 0;

  // Si la temperatura es alta, usar el aire acondicionado
  if (temperatura > 25) {
    horasUsoClimaCuarto = Math.floor(Math.random() * 5) + 1; // De 1 a 5 horas en los cuartos
    horasUsoClimaSala = Math.floor(Math.random() * 5) + 1; // De 1 a 5 horas en la sala
  }

  // Consumo total de energía
  const consumoTotal =
    climaPorCuarto * 4 * horasUsoClimaCuarto * consumoPorHoraPorClima + // Aires en cuartos
    climaEnSala * horasUsoClimaSala * consumoPorHoraPorClima + // Aire en la sala
    horasUsoRefrigerador * consumoPorHoraRefrigerador + // Refrigerador
    horasUsoLuces * consumoPorHoraLuces; // Luces

  // Generar un consumo realista con variación
  const variacion = Math.random() < 0.5 ? 1 : -1; // Variación aleatoria
  const consumoRealista =
    consumoTotal + variacion * Math.floor(Math.random() * 5); // Variación de -5 a +5 kWh

  return Math.max(consumoRealista, 0); // Asegurarse de que no sea negativo
}

// Función para agregar un nuevo dato cada 10 segundos
setInterval(() => {
  if (dataPointIndex < labels.length) {
    // Asegurarse de que no exceda el número de etiquetas
    // Genera un nuevo dato realista
    const newData = generarConsumoKWh(); // Genera un nuevo dato de consumo

    // Agrega el nuevo dato al dataset en la posición correspondiente
    chart1.data.datasets[0].data[dataPointIndex] = newData;

    // Actualiza el costo eléctrico en la gráfica 2 usando la función de cálculo
    chart2.data.datasets[0].data[dataPointIndex] = calcularCosto(newData);

    // Aumenta el índice de puntos de datos
    dataPointIndex++;

    // Llama a update para redibujar la gráfica
    chart1.update();
    chart2.update(); // Actualiza la gráfica 2
  }
}, 1000); // 10000 ms = 10 segundos

var ctx2 = document.getElementById("chart2").getContext("2d");
var chart2 = new Chart(ctx2, {
  type: "bar",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Costo Electrico en Tiempo Real",
        data: new Array(labels.length).fill(0), // Inicialmente llena con 0
        backgroundColor: "rgba(40, 167, 69, 0.6)",
        borderColor: "#28A745",
        borderWidth: 1,
        borderRadius: 5, // Bordes redondeados
        barPercentage: 0.8,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
        labels: {
          color: "#333",
          font: {
            size: 15,
          },
        },
      },
      tooltip: {
        backgroundColor: "rgba(40, 167, 69, 0.8)",
        titleColor: "#fff",
        bodyColor: "#fff",
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: "Costo (MXN)",
        },
      },
      x: {
        grid: {
          display: false,
        },
        title: {
          display: true,
          text: "Tiempo",
        },
      },
    },
  },
});
document.getElementById("yearSelect").addEventListener("change", function () {
  const selectedYear = this.value;

  // Asegúrate de que el año seleccionado no esté vacío
  if (selectedYear) {
    $.ajax({
      url: "../controllers/graficas_controller.php",
      type: "POST",
      data: {
        anio: selectedYear,
      },
      dataType: "json",
      success: function (response) {
        if (response.meses && response.consumo) {
          chart3.data.labels = response.meses;
          chart3.data.datasets[0].data = response.consumo;
          chart3.update();
        } else {
          console.error("Respuesta inesperada: ", response);
        }
      },
      error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", error);
        console.log("Respuesta del servidor:", xhr.responseText);
      },
    });
  } else {
    console.error("No se seleccionó un año válido.");
  }
});

// Configuración inicial de la gráfica 3
var ctx3 = document.getElementById("chart3").getContext("2d");
var chart3 = new Chart(ctx3, {
  type: "line",
  data: {
    labels: [], // Las etiquetas se actualizarán con los meses
    datasets: [
      {
        label: "Consumo Eléctrico por Mes",
        data: [], // Los datos se actualizarán con el consumo
        backgroundColor: "rgba(40, 167, 69, 0.6)",
        borderColor: "#28A745",
        borderWidth: 2,
        fill: false, // No llenar el área bajo la línea
        pointBackgroundColor: "#ffffff", // Puntos en blanco
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: true,
        labels: {
          color: "#333",
          font: {
            size: 15,
          },
        },
      },
      tooltip: {
        backgroundColor: "rgba(40, 167, 69, 0.8)",
        titleColor: "#fff",
        bodyColor: "#fff",
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: "Consumo (kWh)",
        },
      },
      x: {
        grid: {
          display: false,
        },
        title: {
          display: true,
          text: "Mes",
        },
      },
    },
  },
});
