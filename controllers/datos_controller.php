<?php
require_once '../php/security.php'; // Si la ruta es correcta
include '../php/db.php'; // Asegúrate de incluir la conexión a la base de datos

$year = $_GET['year'] ?? null;
$userId = $_SESSION['user_id'];

if ($year === 'todos') {
    // Si el parámetro 'year' es 'todos', no filtramos por año en la consulta, pero ordenamos por año y mes
    $query = "SELECT m.nombre AS mes, e.consumo, e.costo, e.anio 
              FROM estados_consumo e
              JOIN meses m ON e.mes_id = m.id
              WHERE e.usuario_id = ?
              ORDER BY e.anio ASC, e.mes_id ASC"; // Ordena primero por año y luego por mes
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
} elseif ($year) {
    // Si 'year' tiene un valor específico, filtramos por el año
    $query = "SELECT m.nombre AS mes, e.consumo, e.costo, e.anio 
              FROM estados_consumo e
              JOIN meses m ON e.mes_id = m.id
              WHERE e.anio = ? AND e.usuario_id = ?
              ORDER BY e.mes_id"; // Ordena solo por mes para un año específico
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $year, $userId);
}

$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
