<?php
session_start();
// Verifica que la sesión esté iniciada y que 'user_id' esté definido y válido
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Opcional: Registrar intento de acceso no autorizado
    error_log("Intento de acceso no autorizado el " . date('Y-m-d H:i:s') . " desde IP: " . $_SERVER['REMOTE_ADDR']);

    // Redirigir al usuario al login si no está autenticado
    header("Location: ../index.php");
    exit();
}
