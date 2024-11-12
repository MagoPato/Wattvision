<?php

function loadEnv($file)
{
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignorar comentarios
            if (strpos($line, '#') === 0) {
                continue;
            }
            // Separar la clave y el valor por el signo igual
            list($key, $value) = explode('=', $line, 2);
            // Eliminar espacios adicionales y asignar la variable
            $key = trim($key);
            $value = trim($value);
            // Definir las variables de entorno
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    } else {
        die("El archivo .env no existe.");
    }
}

loadEnv(__DIR__ . '/../.env');

$host =     getenv('DB_HOST'); // XAMPP usa 'localhost' como host
$dbname = getenv('DB_NAME'); // Nombre de la base de datos
$username = getenv('DB_USER'); // Usuario predeterminado en XAMPP
$password = getenv('DB_PASS'); // Contraseña predeterminada en XAMPP está vacía

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);

$conn->set_charset("utf8mb4");

// Verificar conexión
if ($conn->connect_error) {
    error_log("Conexión fallida: " . $conn->connect_error); // Registrar error en log
    die("Ocurrió un problema en la conexión a la base de datos."); // Mensaje genérico
}
