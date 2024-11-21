<?php
require_once '../php/security.php'; // Si la ruta es correcta
include '../controllers/select_años.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explora las gráficas interactivas de consumo energético en Wattvision. Selecciona un año para visualizar estadísticas de consumo y obtener un análisis visual detallado.">
    <title>Navegación con Bootstrap 4</title>
    <!-- CSS de Bootstrap -->
    <?php include '../partials/header.php'; ?>
    <link rel="stylesheet" href="../css/graficas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>

<body>

    <?php include '../partials/nav.php'; ?>


    <!-- Contenido principal -->
    <main class="p-5" style="flex-grow: 1;">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="widget">
                    <h2>Gráfica 1</h2>
                    <canvas id="chart1"></canvas>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="widget">
                    <h2>Gráfica 2</h2>
                    <canvas id="chart2"></canvas>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="widget">
                    <div class="d-flex align-items-center justify-content-between">
                        <h2>Gráfica 3</h2>
                        <!-- Selector de año -->
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
                    <canvas id="chart3"></canvas>
                </div>
            </div>
        </div>
        <!-- Nueva fila para la tercera gráfica -->

    </main>

    </div>

    <!-- JS de Bootstrap y Chart.js para las gráficas -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/graficas.js"></script>

</body>

</html>