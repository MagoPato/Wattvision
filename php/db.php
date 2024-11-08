<?php
$host = 'localhost'; // XAMPP usa 'localhost' como host
$dbname = 'wattvision'; // Nombre de la base de datos
$username = 'root'; // Usuario predeterminado en XAMPP
$password = ''; // Contraseña predeterminada en XAMPP está vacía

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
