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
    <title>Wattvision</title>
    <?php include '../partials/header.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

</head>


<body>
    <?php include '../partials/nav.php'; ?>

    <main class=" p-5" style="flex-grow: 1;">
        <div class="card mb-3">
            <div class="card-body">
                <div class="title">
                    Costo estimado: <span id="costo_estimado"></span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="mt-4">
                <select id="aparato" class="custom-select w-auto" onchange="configurarEntradas()">
                    <option value="0" disabled selected>Seleccione el dispositivo</option>
                </select>
            </div>

            <div class="mt-3">
                <h5>Entradas en Uso</h5>
                <div class="entry" id="entrada1">
                    <div><i class="bi bi-lightning-fill"></i> Entrada 1</div>
                    <div class="potencia" id="potencia1">0w</div>
                </div>
                <div class="entry" id="entrada2">
                    <div><i class="bi bi-lightning-fill"></i> Entrada 2</div>
                    <div class="potencia" id="potencia2">0w</div>
                </div>
                <div class="entry" id="entrada3">
                    <div><i class="bi bi-lightning-fill"></i> Entrada 3</div>
                    <div class="potencia" id="potencia3">0w</div>
                </div>
                <div class="entry" id="entrada4">
                    <div><i class="bi bi-lightning-fill"></i> Entrada 4</div>
                    <div class="potencia" id="potencia4">0w</div>
                </div>
                <div class="entry" id="entrada5">
                    <div><i class="bi bi-lightning-fill"></i> Entrada 5</div>
                    <div class="potencia" id="potencia5">0w</div>
                </div>
                <div class="entry" id="entrada6">
                    <div><i class="bi bi-lightning-fill"></i> Entrada 6</div>
                    <div class="potencia" id="potencia6">0w</div>
                </div>
                <div class="entry" id="entrada7">
                    <div><i class="bi bi-lightning-fill"></i> Entrada 7</div>
                    <div class="potencia" id="potencia7">0w</div>
                </div>
                <div class="entry" id="entrada8">
                    <div><i class="bi bi-lightning-fill"></i> Entrada 8</div>
                    <div class="potencia" id="potencia8">0w</div>
                </div>
            </div>

            <div class="status">
                Estable
            </div>
        </div>
    </main>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/dipositivos.js"></script>
</body>

</html>