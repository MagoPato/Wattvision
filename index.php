<?php
session_start(); // Iniciar la sesión al principio
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Inicia sesión en Wattvision para acceder a tus datos de consumo eléctrico y administrar tus preferencias. Accede fácilmente a la plataforma con tu correo electrónico y contraseña.">
    <title>Wattvision - Login</title>
    <link rel="icon" href="img/icono.png" type="image/png"> <!-- Ruta al favicon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/cursor.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <div class="logo-container">
        <img src="img/logo.png" alt="Wattvision Logo">
        <div class="logo-text">WattVision</div>
    </div>
    <div class="login-container">
        <h2>Login</h2>
        <form action="controllers/login_controller.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="form-group text-left">
                <label for="remember">
                    <input type="checkbox" id="remember">
                    Recordar sesión
                </label>
            </div>
            <button type="submit">Ingresar</button>
            <div class="mt-3">
                <a href="#">¿Olvidé mi contraseña?</a>
            </div>
            <div class="mt-3">
                <small>¿No tienes cuenta? <a href="views/registro.php">Regístrate</a></small>
            </div>
        </form>
    </div>

    <?php
    if (isset($_SESSION['error'])) {
        // Usa json_encode para evitar problemas con caracteres especiales
        $error_message = json_encode($_SESSION['error']);
        echo "<script>alert($error_message);</script>";
        unset($_SESSION['error']); // Eliminar el mensaje de error después de mostrarlo
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>