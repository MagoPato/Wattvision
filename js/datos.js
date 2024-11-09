document.addEventListener("DOMContentLoaded", function () {
  const choices = new Choices("#yearSelect", {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: "Seleccione un año",
    itemSelectText: "",
    noChoicesText: "Sin Datos",
    noResultsText: "No hay opciones disponibles",
  });

  // Llamar a showEmptyRows si no hay año seleccionado inicialmente
  const selectedYear = document.getElementById("yearSelect").value;
  if (!selectedYear) {
    showEmptyRows();
  }

  document.getElementById("yearSelect").addEventListener("change", function () {
    const selectedYear = this.value;
    if (selectedYear) {
      fetchConsumptionData(selectedYear);
    } else {
      // Si no hay año seleccionado, mostrar filas vacías con guiones
      showEmptyRows();
    }
  });
});

// Function to fetch and display consumption data for a selected year
function fetchConsumptionData(year) {
  const tableBody = document.getElementById("tableBody");

  $.ajax({
    url: `../controllers/datos_controller.php?year=${year}`,
    type: "GET",
    dataType: "json",
    success: function (data) {
      // Obtener el número actual de filas en la tabla
      const currentRows = tableBody.getElementsByClassName("table-row");

      if (data.length) {
        // Eliminar las filas adicionales si hay menos datos
        while (currentRows.length > data.length) {
          tableBody.removeChild(currentRows[currentRows.length - 1]);
        }

        // Agregar nuevas filas si hay más datos
        data.forEach((row, index) => {
          if (currentRows[index]) {
            // Si ya existe una fila, solo actualiza el contenido
            currentRows[index].innerHTML = `
              <td>${row.mes}</td>
              <td>${row.consumo} kWh</td>
              <td>$${parseFloat(row.costo).toLocaleString("en-US", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
              })}  MXN</td>
            `;
          } else {
            // Si no existe una fila, crea una nueva
            const tableRow = document.createElement("tr");
            tableRow.className = "table-row";
            tableRow.innerHTML = `
              <td>${row.mes}</td>
              <td>${row.consumo} kWh</td>
              <td>$${parseFloat(row.costo).toLocaleString("en-US", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
              })}  MXN</td>
            `;
            tableBody.appendChild(tableRow);
          }
        });
      } else {
        // Si no hay datos, mostrar filas vacías
        showEmptyRows();
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
      tableBody.innerHTML =
        '<tr><td colspan="3">Error al cargar los datos</td></tr>';
    },
  });
}

// Function to display empty rows with dashes
function showEmptyRows() {
  const tableBody = document.getElementById("tableBody");

  // Limpiar las filas existentes
  const rows = tableBody.getElementsByClassName("table-row");
  for (let i = 0; i < rows.length; i++) {
    tableBody.removeChild(rows[i]);
  }

  // Agregar filas vacías con guiones
  for (let i = 0; i < 5; i++) {
    const row = document.createElement("tr");
    row.className = "table-row";
    row.innerHTML = `
            <td>-</td>
            <td>-</td>
            <td>-</td>
        `;
    tableBody.appendChild(row);
  }
}
