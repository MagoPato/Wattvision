<?php
// Obtiene el nombre del archivo actual
$page = htmlspecialchars(basename($_SERVER['PHP_SELF']));

// Función para verificar la compatibilidad con WebP
function isWebPSupported()
{
    return strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false;
}

// Función para obtener la URL de la imagen en el formato correcto
function getImage($filename)
{
    $extension = isWebPSupported() ? '.webp' : '.png';
    return imgWithVersion("../img/{$filename}{$extension}");
}

// Genera una URL con el timestamp del archivo para evitar problemas de caché
if (!function_exists('imgWithVersion')) {
    function imgWithVersion($path)
    {
        return $path . '?v=' . filemtime($path);
    }
}

// Definir las imágenes de los iconos
$iconos = [
    'iconoGraficaImagen' => 'icon-Grafica',
    'iconoDatosImagen' => 'icon-Datos',
    'iconoInicioImagen' => 'icon-Inicio',
    'iconoInforme' => 'informacion',
    'iconoPerfil' => 'perfil_web',
    'iconoPerfil_movil' => 'perfil_movil',
    'iconoDipositivo_web'    => 'dispositivo_web',
    'iconoDipositivo_movil'    => 'dispositivo_movil',
    'iconoLogo'    => 'logo'

];

// Cambia las imágenes según la página actual
foreach ($iconos as $variable => $filename) {
    $$variable = getImage($filename);
}

// Cambiar las imágenes activas según la página actual
switch ($page) {
    case 'inicio.php':
        $iconoInicioImagen = getImage("icon-Inicio-activo");
        break;
    case 'Graficas.php':
        $iconoGraficaImagen = getImage("icon-Grafica-activo");
        break;
    case 'datos.php':
        $iconoDatosImagen = getImage("icon-Datos-activo");
        break;
    case 'ayuda.php':
        $iconoInforme = getImage("informacion_activo");
        break;
    case 'perfil.php':
        $iconoPerfil = getImage("perfil_activo"); // versión web
        $iconoPerfil_movil = getImage("perfil_activo"); // versión móvil
        break;
}
$navClassInicio = $page == "inicio.php" ? "#" : "../views/inicio";
$navClassGraficas = $page == "Graficas.php" ? "#" : "../views/Graficas";
$navClassDatos = $page == "Datos.php" ? "#" : "../views/datos";
$navClassAyuda = $page == "ayuda.php" ? "#" : "../views/ayuda";
?>

<!-- Barra de navegación superior (solo para pantallas grandes) -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-none d-md-flex align-items-center" href="../views/inicio">
            <img src="<?php echo $iconoLogo; ?>" alt="Logo" style="width: 40px; height: 44px;"> <!-- Cambia a ../ -->
            <span class="ml-2"
                style="font-family: 'Arial Rounded MT Bold', sans-serif; font-size: 1.7rem;">WATTVISION</span>
        </a>

        <!-- Botón de menú hamburguesa en móvil con imagen -->
        <a href="perfil" class="navbar-toggler d-md-none" data-target="#navbarContent">
            <img src="<?php echo $iconoPerfil_movil; ?>" alt=" Menú" style="width: 36px; height: 36px;">
        </a>

        <!-- Icono de más a la derecha en móvil con PNG diferente -->
        <a href="../views/dispositivo" class="text-white d-flex align-items-center">
            <img src="<?php echo $iconoDipositivo_movil; ?>" alt="Icono móvil" class="d-md-none" style="width: 45px; height: 45px;"> <!-- Cambia a ../ -->
            <img src="<?php echo $iconoDipositivo_web; ?>" alt="Icono web" class="d-none d-md-block" style="width: 45px; height: 45px;"> <!-- Cambia a ../ -->
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
                <img src="<?php echo $iconoInicioImagen; ?>" alt="Inicio" style="width: 33px; height: 33px;">
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
                <a href="../views/perfil" class="nav-link text-white d-flex align-items-center">
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