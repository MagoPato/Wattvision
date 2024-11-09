<?php
require_once '../php/security.php'; // Si la ruta es correcta
include '../php/db.php'; // Asegúrate de incluir la conexión a la base de datos

$year = $_GET['year'] ?? null;
if ($year) {
    $userId = $_SESSION['user_id'];

    $query = "SELECT m.nombre AS mes, e.consumo, e.costo 
              FROM estados_consumo e
              JOIN meses m ON e.mes_id = m.id
              WHERE e.anio = ? AND e.usuario_id = ?
              ORDER BY e.mes_id";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $year, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}
