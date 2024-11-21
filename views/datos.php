<?php
require_once '../php/security.php'; // Si la ruta es correcta
include '../controllers/select_años.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Consulta el estado de consumo de energía por año, con detalles de consumo mensual y costo asociado. Visualiza los datos de manera fácil y accesible.">
    <title>Estado de Consumo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <?php include '../partials/header.php'; ?>

    <link rel="stylesheet" href="../css/datos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

</head>

<body>
    <?php include '../partials/nav.php'; ?>

    <main class="d-flex flex-column justify-content-center align-items-center">
        <div class="table-container">
            <div class="d-flex align-items-center justify-content-between">
                <h2>Estado de consumo</h1>
                    <select id="yearSelect" class="form-control mb-2" style="width: 200px;">
                        <option value="" disabled selected>Seleccione un año</option>
                        <?php
                        // Si hay años en la base de datos, se generan las opciones
                        if (!empty($years)) {
                            // Si hay más de 2 años, agregamos la opción "Todos"
                            if (count($years) > 2) {
                                echo "<option value='todos'>Años</option>"; // Aquí agregamos la opción "Todos"
                            }

                            foreach ($years as $year) {
                                echo "<option value=\"{$year['anio']}\">{$year['anio']}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No hay datos de consumo disponibles</option>";
                        }
                        ?>
                    </select>
            </div>

            <table class="table table-striped">
                <thead class="table-header">
                    <tr>
                        <th>Meses</th>
                        <th>Consumo</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table rows will be populated by JavaScript -->
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/datos.js"></script>
</body>

</html>