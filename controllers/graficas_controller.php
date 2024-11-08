<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirigir al login si no está autenticado
    exit();
}
include '../php/db.php'; // Archivo para la conexión a la base de datos

$anio = isset($_POST['anio']) ? $_POST['anio'] : null;
$user_id = $_SESSION['user_id']; // Obtener el ID del usuario de la sesión

if ($anio) {
    $query = "SELECT m.nombre AS mes, ec.consumo 
              FROM estados_consumo ec 
              JOIN meses m ON ec.mes_id = m.id 
              WHERE ec.anio = ? AND ec.usuario_id = ?"; // Añadir condición para el usuario

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $anio, $user_id); // Vincular los parámetros de entrada
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data['meses'][] = $row['mes'];
        $data['consumo'][] = (float)$row['consumo'];
    }

    echo json_encode($data);
}
