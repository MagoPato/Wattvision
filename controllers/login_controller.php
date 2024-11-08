<?php
session_start(); // Iniciar sesión para manejar la sesión del usuario
require_once '../php/db.php'; // Incluir el archivo de conexión a la base de datos

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para buscar el usuario en la base de datos
    $sql = "SELECT * FROM users WHERE email = ? LIMIT 1"; // Cambia 'users' por el nombre real de tu tabla
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // 's' significa que el parámetro es una cadena
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña
        if (md5($password) === $user['password']) { // Cambia 'password' por el nombre real de tu columna de contraseña
            $_SESSION['user_id'] = $user['id']; // Guardar el ID del usuario en la sesión
            $_SESSION['user_email'] = $user['email']; // Guardar el email en la sesión

            // Redireccionar al usuario a la página principal después del inicio de sesión
            header("Location: ../views/inicio.php"); // Cambia 'home.php' por la ruta de tu página principal
            exit();
        } else {
            $_SESSION['error'] = "Contraseña incorrecta.";
            header("Location: ../index.php"); // Redirigir a la página de inicio de sesión
            exit();
        }
    } else {
        $_SESSION['error'] = "No se encontró un usuario con ese correo electrónico.";
        header("Location: ../index.php"); // Redirigir a la página de inicio de sesión
        exit();
    }
}
