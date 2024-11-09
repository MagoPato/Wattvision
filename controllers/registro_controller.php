<?php
// Incluir archivo de conexión a la base de datos
require_once '../php/security.php'; // Si la ruta es correcta
include '../php/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = trim($_POST['usuario']); // Campo 'usuario' en el formulario
    $email = trim($_POST['correo']);
    $password = trim($_POST['password']);

    // Verificar que no estén vacíos
    if (empty($nombre) || empty($email) || empty($password)) {
        echo "Por favor completa todos los campos.";
        exit;
    }

    // Validar formato de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico no válido.";
        exit;
    }

    // Cifrar la contraseña con md5
    $password_hash = md5($password);

    // Preparar la consulta SQL
    $sql = "INSERT INTO users (nombre, email, password) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) { // Preparar la declaración
        $stmt->bind_param("sss", $nombre, $email, $password_hash); // Enlazar parámetros

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            // Registro exitoso, redirigir a la página de inicio de sesión con mensaje de éxito
            $_SESSION['success'] = "Registro exitoso. Puedes iniciar sesión ahora.";
            header("Location: ../index.php");
            exit;
        } else {
            // Ocurrió un error
            echo "Error al registrar: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        // Error al preparar la consulta
        echo "Error al preparar la consulta: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Redirigir a la página de registro si no es una solicitud POST
    header("Location: ../views/registro.php");
    exit;
}
