<?php
session_start();
require 'config.php'; // Conexión a la base de datos

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['contraseña'];
    
    $conn = new mysqli("localhost", "root", "", "banco");
    
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($query);
    
    if ($result === false) {
        $error_message = "Error en la consulta SQL: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['contraseña'];
            if (password_verify($password, $hashed_password)) {
                // si la contraseña es corecta  iniciar sesión
                $_SESSION['email'] = $email;
                header(header: "Location: index.html ");
                exit();
            } else {
                // La contraseña es incorrecta
                $error_message = "La contraseña es incorrecta";
            }
            $error_message = "El usuario existe en la base de datos";
        } else {
            // El usuario no existe
            $error_message = "El usuario no existe en la base de datos";
        }
    }
    $conn->close();
}
?>