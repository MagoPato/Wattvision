<?php
$host = 'localhost'; // XAMPP usa 'localhost' como host
$dbname = 'wattvision'; // Nombre de la base de datos
$username = 'root'; // Usuario predeterminado en XAMPP
$password = ''; // Contraseña predeterminada en XAMPP está vacía

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);

$conn->set_charset("utf8mb4");

// Verificar conexión
if ($conn->connect_error) {
    error_log("Conexión fallida: " . $conn->connect_error); // Registrar error en log
    die("Ocurrió un problema en la conexión a la base de datos."); // Mensaje genérico
}
