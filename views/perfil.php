<?php
require_once '../php/security.php'; // Si la ruta es correcta

include '../controllers/perfil_controller.php'; ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Accede a tu perfil en Wattvision para gestionar tu cuenta. Revisa tu información personal y cierra sesión cuando lo desees.">
    <title>Perfil</title>
    <!-- CSS de Bootstrap -->
    <?php include '../partials/header.php'; ?>
    <link rel="stylesheet" href="../css/prefil.css">
</head>

<body>
    <?php include '../partials/nav.php'; ?>



    <!-- Contenido principal -->
    <main class="p-4" style="flex-grow: 1;">
        <div class="profile-container">
            <h1>Perfil</h1>
            <form action="../php/logout.php" method="post">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" class="form-control" value="<?php echo htmlspecialchars($nombre); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" class="form-control" value="********" readonly>
                </div>
                <button type="submit" class="btn btn-logout">Cerrar sesión</button>
            </form>
        </div>
    </main>

    <!-- JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>