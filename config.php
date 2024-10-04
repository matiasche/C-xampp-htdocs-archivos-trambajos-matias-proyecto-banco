<?php
$localhost = "localhost";
$banco = "banco";
$username = "root";
$password = "";

// Crear conexión
$conn = new mysqli($localhost, $username, $password, $banco);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
