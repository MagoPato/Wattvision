document.addEventListener("DOMContentLoaded", function () {
  const choices = new Choices("#yearSelect", {
    searchEnabled: false, // Desactiva la búsqueda si no es necesaria
    placeholder: true, //
    placeholderValue: "Seleccione un año",
    itemSelectText: "Seleccione",
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
        backgroundColor: function (context) {
          // Crear un degradado con más variedad de tonos
          var gradient = ctx1.createLinearGradient(
            0,
            0,
            0,
            context.chart.height
          );

          // Definir colores más ricos en el gradiente
          gradient.addColorStop(0, "rgba(40, 167, 69, 0.8)"); // Verde fuerte y saturado al principio
          gradient.addColorStop(0.25, "rgba(40, 167, 69, 0.6)"); // Transición suave hacia opacidad media
          gradient.addColorStop(0.5, "rgba(60, 179, 113, 0.4)"); // Verde un poco más suave y fresco
          gradient.addColorStop(0.75, "rgba(70, 190, 130, 0.2)"); // Verde más claro, más opaco
          gradient.addColorStop(1, "rgba(144, 238, 144, 0.1)"); // Un verde muy claro y casi transparente

          return gradient;
        }, // Fondo más suave
        borderColor: "#28A745",
        borderWidth: 3,
        fill: true, // Llenar el área bajo la línea con un color suave
        pointBackgroundColor: "#ffffff", // Puntos en blanco
        pointBorderColor: "#28A745", // Bordes de los puntos en verde
        pointBorderWidth: 3,
        pointRadius: 5, // Tamaño de los puntos más grande
        hoverRadius: 7, // Tamaño al hacer hover sobre los puntos
        hoverBackgroundColor: "#28A745", // Color al pasar el mouse
        hoverBorderColor: "#fff", // Color de borde al hacer hover
        hoverBorderWidth: 2, // Borde más grueso al hacer hover
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
      duration: 1000, // Duración de la animación
      easing: "easeInOutQuad", // Efecto de animación más suave
    },
    plugins: {
      legend: {
        display: true,
        position: "top",
        labels: {
          color: "#333",
          font: {
            size: 14, // Aumenta el tamaño de la fuente para mayor claridad
            weight: "bold",
          },
        },
      },
      tooltip: {
        backgroundColor: "rgba(40, 167, 69, 0.9)", // Fondo más opaco para el tooltip
        titleColor: "#fff",
        bodyColor: "#fff",
        bodyFont: {
          size: 16, // Mayor tamaño de fuente para el cuerpo del tooltip
        },
        cornerRadius: 10, // Bordes más redondeados
        padding: 12, // Más espacio dentro del tooltip
        displayColors: false, // Eliminar el color de la leyenda en los tooltips
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: "Consumo (kWh)",
          color: "#28A745", // Color verde para el título del eje Y
          font: {
            size: 16, // Aumenta el tamaño de la fuente
            weight: "bold",
          },
        },
        grid: {
          color: "#f2f2f2", // Color más suave para las líneas de la cuadrícula
          borderDash: [5, 5], // Estilo punteado para hacer las líneas menos dominantes
          drawBorder: false, // Quita el borde alrededor del eje y
        },
        ticks: {
          color: "#333", // Color de los ticks (marcas de escala)
          font: {
            size: 14,
            weight: "bold",
          },
        },
      },
      x: {
        grid: {
          display: false, // No mostrar las líneas de la cuadrícula en el eje X
        },
        title: {
          display: true,
          text: "Tiempo",
          color: "#28A745", // Color verde para el título del eje X
          font: {
            size: 16,
            weight: "bold",
          },
        },
        ticks: {
          color: "#333", // Color de los ticks (marcas de escala)
          font: {
            size: 14,
            weight: "bold",
          },
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
        label: "Costo Eléctrico en Tiempo Real",
        data: new Array(labels.length).fill(0), // Inicialmente llena con 0
        backgroundColor: "rgba(40, 167, 69, 0.6)",
        borderColor: "#28A745",
        borderWidth: 2,
        borderRadius: 6, // Bordes redondeados más pronunciados
        barPercentage: 0.8,
        hoverBackgroundColor: "rgba(40, 167, 69, 0.8)", // Color más intenso al hacer hover
        hoverBorderColor: "#28A745", // Borde verde al pasar el mouse
        hoverBorderWidth: 3, // Borde más grueso al hacer hover
        tension: 0.2, // Suaviza la animación para el gráfico de barras
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
      duration: 800, // Animación más rápida para una carga más ágil
      easing: "easeInOutQuart", // Efecto de animación más fluido
    },
    plugins: {
      legend: {
        display: true,
        position: "top",
        labels: {
          color: "#333",
          font: {
            size: 14,
            weight: "bold", // Texto en negrita para mejor visibilidad
          },
        },
      },
      tooltip: {
        backgroundColor: "rgba(40, 167, 69, 0.9)", // Fondo más opaco para el tooltip
        titleColor: "#fff",
        bodyColor: "#fff",
        bodyFont: {
          size: 16, // Aumenta el tamaño de la fuente para el cuerpo del tooltip
        },
        cornerRadius: 8, // Bordes redondeados en los tooltips
        padding: 12, // Aumenta el espacio dentro del tooltip
        displayColors: false, // Eliminar color de la leyenda en los tooltips
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: "Costo (MXN)",
          color: "#28A745", // Título del eje Y en verde
          font: {
            size: 16, // Aumenta el tamaño de la fuente para el título del eje Y
            weight: "bold",
          },
        },
        grid: {
          color: "#f2f2f2", // Color suave para las líneas de la cuadrícula
          lineWidth: 1,
          borderDash: [5, 5], // Líneas discontinuas en la cuadrícula
        },
        ticks: {
          color: "#333", // Color para los ticks
          font: {
            size: 14,
            weight: "bold",
          },
        },
      },
      x: {
        grid: {
          display: false, // No mostrar las líneas de la cuadrícula en el eje X
        },
        title: {
          display: true,
          text: "Tiempo",
          color: "#28A745", // Título del eje X en verde
          font: {
            size: 16,
            weight: "bold",
          },
        },
        ticks: {
          color: "#333", // Color para los ticks
          font: {
            size: 14,
            weight: "bold",
          },
        },
      },
    },
  },
});

var años = false;
document.getElementById("yearSelect").addEventListener("change", function () {
  const selectedYear = this.value;

  // Si se selecciona "todo"
  if (selectedYear === "todos") {
    años = true;
    if (años) {
      chart3.options.scales.x.title.text = "Años";
      chart3.data.datasets[0].label = "Consumo Eléctrico por Años";
    }

    $.ajax({
      url: "../controllers/graficas_controller.php",
      type: "POST",
      data: {
        anio: "todos", // O puedes omitir el valor si el backend lo maneja diferente
      },
      dataType: "json",
      success: function (response) {
        if (response.meses && response.consumo && response.anios) {
          // Concatenar meses y años para las etiquetas
          chart3.data.labels = response.meses.map(
            (mes, index) => `${mes} ${response.anios[index]}`
          );
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
  } else if (selectedYear) {
    años = false;
    if (!años) {
      chart3.options.scales.x.title.text = "Meses";
      chart3.data.datasets[0].label = "Consumo Eléctrico por Meses";
    }

    // Si se selecciona un año específico
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
        label: "Consumo Eléctrico por Meses",
        data: [], // Los datos se actualizarán con el consumo
        backgroundColor: function (context) {
          // Crear un degradado con más variedad de tonos
          var gradient = ctx1.createLinearGradient(
            0,
            0,
            0,
            context.chart.height
          );

          // Definir colores más ricos en el gradiente
          gradient.addColorStop(0, "rgba(40, 167, 69, 0.8)"); // Verde fuerte y saturado al principio
          gradient.addColorStop(0.25, "rgba(40, 167, 69, 0.6)"); // Transición suave hacia opacidad media
          gradient.addColorStop(0.5, "rgba(60, 179, 113, 0.4)"); // Verde un poco más suave y fresco
          gradient.addColorStop(0.75, "rgba(70, 190, 130, 0.2)"); // Verde más claro, más opaco
          gradient.addColorStop(1, "rgba(144, 238, 144, 0.1)"); // Un verde muy claro y casi transparente

          return gradient;
        }, // Fondo más suave
        borderColor: "#28A745",
        borderWidth: 3,
        fill: true, // Llenar el área bajo la línea con un color suave
        pointBackgroundColor: "#ffffff", // Puntos en blanco
        pointBorderColor: "#28A745", // Bordes de los puntos en verde
        pointBorderWidth: 3,
        pointRadius: 5, // Tamaño de los puntos más grande
        hoverRadius: 7, // Tamaño al hacer hover sobre los puntos
        hoverBackgroundColor: "#28A745", // Color al pasar el mouse
        hoverBorderColor: "#fff", // Color de borde al hacer hover
        hoverBorderWidth: 2, // Borde más grueso al hacer hover
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
      duration: 1000, // Duración de la animación
      easing: "easeInOutQuad", // Efecto de animación más suave
    },
    plugins: {
      legend: {
        display: true,
        position: "top", // Colocar la leyenda en la parte superior
        labels: {
          color: "#333", // Color de las etiquetas de la leyenda
          font: {
            size: 14, // Tamaño de la fuente más grande
            weight: "bold", // Fuente en negrita
          },
        },
      },
      tooltip: {
        backgroundColor: "rgba(40, 167, 69, 0.9)", // Fondo del tooltip más opaco
        titleColor: "#fff", // Color del título del tooltip
        bodyColor: "#fff", // Color del cuerpo del tooltip
        bodyFont: {
          size: 16, // Tamaño de la fuente en el cuerpo del tooltip
        },
        cornerRadius: 8, // Bordes redondeados en el tooltip
        padding: 12, // Más espacio dentro del tooltip
        displayColors: false, // Eliminar los colores de la leyenda en los tooltips
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        position: "left",
        title: {
          display: true,
          text: "Consumo (kWh)",
          color: "#28A745", // Título del eje Y en verde
          font: {
            size: 16, // Tamaño de la fuente para el título del eje Y
            weight: "bold", // En negrita
          },
        },
        grid: {
          color: "#f2f2f2", // Líneas de cuadrícula suaves
          borderDash: [5, 5], // Estilo punteado para hacer las líneas menos dominantes
          drawBorder: false, // Quita el borde alrededor del eje y
        },
        ticks: {
          color: "#333", // Color de los ticks
          font: {
            size: 14, // Tamaño de la fuente de los ticks
            weight: "bold",
          },
        },
      },
      x: {
        grid: {
          display: false,
        },
        title: {
          display: true,
          text: "Meses",
          color: "#28A745", // Título del eje X en verde
          font: {
            size: 16, // Tamaño de la fuente para el título del eje X
            weight: "bold", // En negrita
          },
        },
        ticks: {
          callback: function (value, index, values) {
            if (años) {
              const label = this.getLabelForValue(value);
              const year = label.split(" ")[1]; // Extrae el año de la etiqueta.
              const previousLabel =
                index > 0 ? this.getLabelForValue(index - 1) : null;
              const previousYear = previousLabel
                ? previousLabel.split(" ")[1]
                : null;

              // Solo muestra el año si es diferente al del índice anterior.
              if (year !== previousYear) {
                return year;
              }
              return ""; // Si es el mismo año, no muestra nada.
            } else {
              return this.getLabelForValue(value);
            }
          },
          color: "#333", // Color de los ticks
          font: {
            size: 14, // Tamaño de la fuente de los ticks
            weight: "bold",
          },
        },
      },
    },
  },
});
