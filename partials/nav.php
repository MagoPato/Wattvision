<?php
// Obtiene el nombre del archivo actual
$page = basename($_SERVER['PHP_SELF']);

// Imágenes por defecto
$iconoGraficaImagen = "../img/icon-Grafica.png"; // Cambia a ../
$iconoDatosImagen = "../img/icon-Datos.png"; // Cambia a ../
$iconoInicioImagen = "../img/icon-Inicio.png"; // Cambia a ../
$iconoInforme = "../img/informacion.png"; // Cambia a
$iconoPerfil = "../img/perfil_web.png";
$iconoPerfil_movil = "../img/perfil_movil.png";

// Cambia las imágenes según la página actual
if ($page == "inicio.php") {
    $iconoInicioImagen = "../img/icon-inicio-activo.png"; // Cambia a ../
} elseif ($page == "Graficas.php") {
    $iconoGraficaImagen = "../img/icon-Grafica-activo.png"; // Cambia a ../
} elseif ($page == "datos.php") {
    $iconoDatosImagen = "../img/icon-datos-activo.png"; // Cambia a ../
} elseif ($page == "ayuda.php") {
    $iconoInforme = "../img/informacion_activo.png";
} elseif ($page == "perfil.php") {
    $iconoPerfil = "../img/perfil_activo.png";
    $iconoPerfil_movil = "../img/perfil_activo.png";
}

$navClassInicio = $page == "inicio.php" ? "#" : "../views/inicio.php";
$navClassGraficas = $page == "Graficas.php" ? "#" : "../views/Graficas.php";
$navClassDatos = $page == "Datos.php" ? "#" : "../views/datos.php";
$navClassAyuda = $page == "ayuda.php" ? "#" : "../views/ayuda.php";
?>

<!-- Barra de navegación superior (solo para pantallas grandes) -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-none d-md-flex align-items-center" href="../views/inicio.php">
            <img src="../img/logo.png" alt="Logo" style="width: 40px; height: 44px;"> <!-- Cambia a ../ -->
            <span class="ml-2"
                style="font-family: 'Arial Rounded MT Bold', sans-serif; font-size: 1.7rem;">WATTVISION</span>
        </a>

        <!-- Botón de menú hamburguesa en móvil con imagen -->
        <a href="perfil.php" class="navbar-toggler d-md-none" data-target="#navbarContent">
            <img src="<?php echo $iconoPerfil_movil; ?>" alt=" Menú" style="width: 36px; height: 36px;">
        </a>

        <!-- Icono de más a la derecha en móvil con PNG diferente -->
        <a href="../views/dispositivo.php" class="text-white d-flex align-items-center">
            <img src="../img/dispositivo_movil.png" alt="Icono móvil" class="d-md-none" style="width: 45px; height: 45px;"> <!-- Cambia a ../ -->
            <img src="../img/dispositivo_web.png" alt="Icono web" class="d-none d-md-block" style="width: 45px; height: 45px;"> <!-- Cambia a ../ -->
        </a>
    </div>
</nav>

<!-- Barra de navegación inferior para pantallas pequeñas -->
<nav class="navbar navbar-dark fixed-bottom navbar-bottom" style="background-color: black; padding: 15px 0;">
    <ul class="nav justify-content-around w-100 text-center" style="height: 55px;">
        <li class="nav-item">
            <a class="nav-link text-white d-flex flex-column align-items-center" href="<?php echo $navClassGraficas; ?>"
                style="padding: 0;">
                <img src="<?php echo $iconoGraficaImagen; ?>" alt="Gráficas" style="width: 33px; height: 33px;">
                <span class="mt-1" style="font-size: 12px;">Gráficas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white d-flex flex-column align-items-center" href="<?php echo $navClassInicio; ?>"
                style="padding: 0;">
                <img src="<?php echo $iconoInicioImagen; ?>" alt="Inicio" style="width: 38px; height: 38px;">
                <span class="mt-1" style="font-size: 12px;">Inicio</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white d-flex flex-column align-items-center" href="<?php echo $navClassDatos; ?>"
                style="padding: 0;">
                <img src="<?php echo $iconoDatosImagen; ?>" alt="Datos" style="width: 33px; height: 33px;">
                <span class="mt-1" style="font-size: 12px;">Datos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white d-flex flex-column align-items-center" href="<?php echo $navClassAyuda; ?>"
                style="padding: 0;">
                <img src="<?php echo $iconoInforme; ?>" alt="Datos" style="width: 33px; height: 33px;">
                <span class="mt-1" style="font-size: 12px;">Ayuda</span>
            </a>
        </li>
    </ul>
</nav>

<div class="d-flex" style="margin-top: 56px;">
    <!-- Barra lateral -->
    <aside class="p-3" style="width: 145px; height: calc(100vh - 56px);">
        <ul class="list-unstyled">
            <li class="nav-item d-flex align-items-center">
                <a href="../views/perfil.php" class="nav-link text-white d-flex align-items-center">
                    <img src="<?php echo $iconoPerfil; ?>" alt="Opción 1" class="mr-2" style="width: 37px; height: 37px;"> <!-- Cambia a ../ -->
                    <span style="color: white;">Perfil</span>
                </a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <a href="<?php echo $navClassGraficas; ?>" class="nav-link text-white d-flex align-items-center">
                    <img src="<?php echo $iconoGraficaImagen; ?>" alt="Opción 2" class="mr-2" style="width: 37px; height: 37px;">
                    <span style="color: white;">Gráficas</span>
                </a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <a href="<?php echo $navClassInicio; ?>" class="nav-link text-white d-flex align-items-center">
                    <img src="<?php echo $iconoInicioImagen; ?>" alt="Opción 3" class="mr-2"
                        style="width: 37px; height: 37px;">
                    <span style="color: white;">Inicio</span>
                </a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <a href="<?php echo $navClassDatos; ?>" class="nav-link text-white d-flex align-items-center">
                    <img src="<?php echo $iconoDatosImagen; ?>" alt="Opción 4" class="mr-2" style="width: 37px; height: 37px;">
                    <span style="color: white;">Datos</span>
                </a>
            </li>
            <li class="nav-item d-flex align-items-center">
                <a href="<?php echo $navClassAyuda; ?>" class="nav-link text-white d-flex align-items-center">
                    <img src="<?php echo $iconoInforme; ?>" alt="Opción 4" class="mr-2" style="width: 37px; height: 37px;">
                    <span style="color: white;">Ayuda</span>
                </a>
            </li>
        </ul>
    </aside>
</div>

<!-- Incluye Bootstrap JS al final del cuerpo -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>