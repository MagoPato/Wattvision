<?php

include '../php/db.php';
// Obtener los años de consumo para el usuario logueado
$userId = $_SESSION['user_id']; // ID del usuario logueado
$query = "SELECT DISTINCT anio FROM estados_consumo WHERE usuario_id = ? ORDER BY anio DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId); // Enlazamos el parámetro
$stmt->execute();
$result = $stmt->get_result();
$years = $result->fetch_all(MYSQLI_ASSOC);

// Obtener todos los meses para mostrarlos más tarde
$monthQuery = "SELECT id, nombre FROM meses";
$monthResult = $conn->query($monthQuery);
$months = $monthResult->fetch_all(MYSQLI_ASSOC);
