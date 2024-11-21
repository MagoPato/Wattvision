<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Regístrate en Wattvision para comenzar a monitorear y gestionar tu consumo eléctrico. Crea una cuenta de usuario fácilmente con tu correo electrónico y contraseña.">
    <title>Wattvision - Reg</title>
    <?php include '../partials/header.php'; ?>
    <link rel="stylesheet" href="../css/registro.css">
</head>

<body>

    <!-- Contenedor del Logo y el texto -->
    <div class="logo-container">
        <img src="../img/logo.png" alt="Wattvision Logo">
        <div class="logo-text">WATTVISION</div>
    </div>

    <!-- Contenedor del Login -->
    <div class="login-container">
        <h2>Registro</h2>
        <form action="../controllers/registro_controller.php" method="post">
            <div class="form-group">
                <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <input type="email" name="correo" class="form-control" placeholder="Correo Electrónico" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Contraseña">
            </div>
            <button type="submit">Registrarse</button>
            <div class="mt-3">

            </div>
            <div class="mt-3">
                <small>¿Ya tienes una cuenta? <a href="../index">Inicia Sesion</a></small>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>