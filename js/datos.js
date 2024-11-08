document.addEventListener("DOMContentLoaded", function () {
  const choices = new Choices("#yearSelect", {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: "Seleccione un año",
    itemSelectText: "",
    noChoicesText: "Sin Datos",
    noResultsText: "No hay opciones disponibles", // Aquí cambias el texto
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
  tableBody.innerHTML = ""; // Clear existing content

  $.ajax({
    url: `../controllers/datos_controller.php?year=${year}`,
    type: "GET",
    dataType: "json",
    success: function (data) {
      if (data.length) {
        data.forEach((row) => {
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
        });
      } else {
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
  tableBody.innerHTML = ""; // Clear existing content
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
