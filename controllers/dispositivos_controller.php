<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirigir al login si no está autenticado
    exit();
}
include '../php/db.php'; // Archivo para la conexión a la base de datos

$user_id = $_SESSION['user_id']; // Obtener el ID del usuario de la sesión

if ($user_id) {
    $query = "SELECT * 
              FROM dispositivos 
              WHERE usuario_id = ?"; // Añadir condición para el usuario

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id); // Vincular los parámetros de entrada
    $stmt->execute();
    $result = $stmt->get_result();

    echo json_encode($result->fetch_all());
}
