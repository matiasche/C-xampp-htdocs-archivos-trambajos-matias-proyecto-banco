<?php
$localhost = "localhost";
$banco = "banco";
$username = "root";
$password = "";

// este metodo se en carga de crear la nueva conecion a la base de datos
$conn = new mysqli($localhost, $username, $password, $banco);

//  y este metodo la Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
