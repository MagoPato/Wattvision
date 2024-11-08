<?php
// Incluir archivo de conexión a la base de datos
include '../php/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = trim($_POST['usuario']); // Cambié 'usuario' a 'nombre' para que coincida con la tabla
    $email = trim($_POST['correo']);
    $password = trim($_POST['password']);

    // Verificar que no estén vacíos
    if (empty($nombre) || empty($email) || empty($password)) {
        echo "Por favor completa todos los campos.";
        exit;
    }

    // Cifrar la contraseña
    $password_hash = md5($password); // Cambia a password_hash() si decides usar un método más seguro.

    // Preparar la consulta SQL
    $sql = "INSERT INTO users (nombre, email, password) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) { // Preparar la declaración
        $stmt->bind_param("sss", $nombre, $email, $password_hash); // Enlazar parámetros

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            // Registro exitoso
            echo "Registro exitoso. Puedes iniciar sesión ahora.";
            header("Location: ../index.php"); // Redirigir a la página de inicio de sesión
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
