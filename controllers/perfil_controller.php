<?php
require_once '../php/security.php'; // Si la ruta es correcta
require_once '../php/db.php'; // Conectar a la base de datos

// Verificar si el usuario está autenticado

$user_id = $_SESSION['user_id']; // Obtener el ID del usuario desde la sesión

// Consultar los datos del usuario en la base de datos
$sql = "SELECT nombre, email FROM users WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nombre = $user['nombre'];
    $email = $user['email'];
} else {
    echo "Error: Usuario no encontrado.";
    exit();
}
