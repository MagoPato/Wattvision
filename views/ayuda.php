<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirigir al login si no está autenticado
    exit();
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Consumo</title>
    <?php include '../partials/header.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/ayuda.css">

</head>

<body>
    <?php include '../partials/nav.php'; ?>
    <main class="p-5" style="flex-grow: 1;">
        <div class="table-container">
            <h2 class="estado-consumo">Costo De Luz CFE</h2>
            <div class="table-responsive"> <!-- Contenedor responsivo -->
                <table class="table table-striped">
                    <thead class="table-header">
                        <tr>
                            <th>Cliente</th>
                            <th>Tarifa</th>
                            <th>Costo/kWh</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Residencial -->
                        <tr class="table-row">
                            <td>Residencial</td>
                            <td class="text">Básica (primeros 300 kWh)</td>
                            <td>$0.595</td>
                        </tr>
                        <tr class="table-row">
                            <td>Residencial</td>
                            <td>Intermedia baja (siguientes 450 kWh)</td>
                            <td>$0.741</td>
                        </tr>
                        <tr class="table-row">
                            <td>Residencial</td>
                            <td>Intermedia alta (siguientes 150 kWh)</td>
                            <td>$0.967</td>
                        </tr>
                        <tr class="table-row">
                            <td>Residencial</td>
                            <td>Alta (mayores a 900 kWh)</td>
                            <td>$1.224</td>
                        </tr>
                        <!-- Empresarial -->
                        <tr class="table-row">
                            <td>Empresarial</td>
                            <td>Pequeña Demanda (hasta 25 kW) en Baja Tensión</td>
                            <td>$2.16 (estimado)</td>
                        </tr>
                        <tr class="table-row">
                            <td>Empresarial</td>
                            <td>Mediana Demanda (25 a 500 kW) en Media Tensión</td>
                            <td>$2.39 (estimado)</td>
                        </tr>
                        <tr class="table-row">
                            <td>Empresarial</td>
                            <td>Alta Tensión (más de 500 kW)</td>
                            <td>$2.59 (estimado)</td>
                        </tr>
                        <!-- Industrial -->
                        <tr class="table-row">
                            <td>Industrial</td>
                            <td>GDMTO (Baja Tensión)</td>
                            <td>Cobro uniforme 24 hrs.</td>
                        </tr>
                        <tr class="table-row">
                            <td>Industrial</td>
                            <td>GDMTH (Media Tensión) - Base</td>
                            <td>$1.0773 (00:00-06:00 hrs.)</td>
                        </tr>
                        <tr class="table-row">
                            <td>Industrial</td>
                            <td>GDMTH (Media Tensión) - Intermedio</td>
                            <td>$1.0576 (06:00-18:00 hrs.)</td>
                        </tr>
                        <tr class="table-row">
                            <td>Industrial</td>
                            <td>GDMTH (Media Tensión) - Punta</td>
                            <td>Mayor a $1.0576 (18:00-23:00 hrs.)</td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- Fin del contenedor responsivo -->
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="title">
                    Esquema de Conexion y Funcionamiento del WATTVISION MONITOR
                </div>
                <div class="container text-center">
                    <img src="../img/Diagramas_conexion.svg" class="img-fluid" alt="Diagrama" style="width: 100%;  height: auto;">
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>