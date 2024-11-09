<?php
require_once '../php/security.php'; // Si la ruta es correcta
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Dispositivos</title>
    <?php include '../partials/header.php'; ?>
    <link rel="stylesheet" href="../css/dipositivo.css">
</head>

<body>
    <?php include '../partials/nav.php'; ?>

    <main class="p-5" style="flex-grow: 1;">
        <h2 class="text-center">Dispositivos Configurables</h2>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="device-option" data-toggle="modal" data-target="#deviceModal">
                    <h5>WATTVISION MONITOR 8</h5>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="device-option" data-toggle="modal" data-target="#deviceModal">
                    <h5>WATTVISION MONITOR 16</h5>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="device-option" data-toggle="modal" data-target="#deviceModal">
                    <h5>WATTVISION MONITOR 24</h5>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="device-option" data-toggle="modal" data-target="#deviceModal">
                    <h5>WATTVISION MONITOR PERSONALIZADO</h5>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="deviceModal" tabindex="-1" role="dialog" aria-labelledby="deviceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deviceModalLabel">Estado de la Función</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Esta función todavía no está habilitada. Estamos trabajando en ella.
                    Por favor, espere a que actualicemos la web y esté disponible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>