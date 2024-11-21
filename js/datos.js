document.addEventListener("DOMContentLoaded", function () {
  const choices = new Choices("#yearSelect", {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: "Seleccione un año",
    itemSelectText: "Seleccione",
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
  if (year === "todos") {
    $.ajax({
      url: `../controllers/datos_controller?year=${year}`,
      type: "GET",
      dataType: "json",
      success: function (data) {
        const rows = tableBody.getElementsByClassName("table-row");

        if (data.length) {
          // Asegurar que haya suficientes filas para los datos
          while (rows.length < data.length) {
            const row = document.createElement("tr");
            row.className = "table-row";
            row.innerHTML = `<td>-</td><td>-</td><td>-</td>`;
            tableBody.appendChild(row);
          }

          // Actualizar filas existentes con los datos obtenidos
          data.forEach((row, index) => {
            rows[index].innerHTML = `
            <td>${row.mes} ${row.anio}</td>
            <td>${row.consumo} kWh</td>
            <td>$${parseFloat(row.costo).toLocaleString("en-US", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}  MXN</td>
          `;
          });

          // Eliminar filas sobrantes si hay más filas que datos
          while (rows.length > data.length) {
            tableBody.removeChild(rows[rows.length - 1]);
          }
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
  } else if (year) {
    $.ajax({
      url: `../controllers/datos_controller?year=${year}`,
      type: "GET",
      dataType: "json",
      success: function (data) {
        const rows = tableBody.getElementsByClassName("table-row");

        if (data.length) {
          // Asegurar que haya suficientes filas para los datos
          while (rows.length < data.length) {
            const row = document.createElement("tr");
            row.className = "table-row";
            row.innerHTML = `<td>-</td><td>-</td><td>-</td>`;
            tableBody.appendChild(row);
          }

          // Actualizar filas existentes con los datos obtenidos
          data.forEach((row, index) => {
            rows[index].innerHTML = `
            <td>${row.mes}</td>
            <td>${row.consumo} kWh</td>
            <td>$${parseFloat(row.costo).toLocaleString("en-US", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
            })}  MXN</td>
          `;
          });

          // Eliminar filas sobrantes si hay más filas que datos
          while (rows.length > data.length) {
            tableBody.removeChild(rows[rows.length - 1]);
          }
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
}

// Function to display empty rows with dashes
function showEmptyRows() {
  const tableBody = document.getElementById("tableBody");

  // Limpiar las filas existentes
  const rows = tableBody.getElementsByClassName("table-row");
  for (let i = rows.length - 1; i >= 0; i--) {
    tableBody.removeChild(rows[i]);
  }

  // Agregar filas vacías con guiones
  for (let i = 0; i < 5; i++) {
    const row = document.createElement("tr");
    row.className = "table-row";
    row.innerHTML = `<td>-</td><td>-</td><td>-</td>`;
    tableBody.appendChild(row);
  }
}
