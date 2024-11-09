<?php

require_once '../php/security.php'; // Si la ruta es correcta
include '../php/db.php'; // Archivo para la conexión a la base de datos


$dispositivo_id = isset($_POST['dispositivo_id']) ? $_POST['dispositivo_id'] : null;
$user_id = $_SESSION['user_id']; // Obtener el ID del usuario de la sesión

if ($dispositivo_id) {
    $query = "SELECT * 
              FROM entradas_dispositivos 
              WHERE dispositivo_id = ?"; // Añadir condición para el usuario

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $dispositivo_id); // Vincular los parámetros de entrada
    $stmt->execute();
    $result = $stmt->get_result();

    echo json_encode($result->fetch_all());
}
