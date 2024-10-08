<?php
session_start(); // Asegurarse de que la sesión esté iniciada

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email' ])) {
    header("Location: login.php"); // Redirigir al inicio de sesión si no hay sesión activa
    exit();
}

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "bano");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Definir variables con valor por defecto
$username = "";
$email = "";
$saldo = "";

// obtenemos  la información del usuario usando la sesión de correo
$email_session = $_SESSION['email'];
$query = "SELECT * FROM usuarios WHERE email = '$email_session'";
$result = $conn->query($query);

// usamos el if para verificar si se optiene la informacion del usuario 
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['nombre']; 
    $email = $row['email'];

    // Obtener la información de la cuenta asociada al usuario
    $query = "SELECT * FROM cuentas WHERE id_usuario = '$row[id_usuario]'";
    $result = $conn->query($query);

    // Verificar si se obtuvo información de la cuenta
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $saldo = $row['saldo'];
    }
} else {
    // Redirigir al login si no se encuentra el usuario
    header("Location: login.html");
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
