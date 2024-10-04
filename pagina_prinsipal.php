<?php
session_start(); // Asegurarse de que la sesión esté iniciada

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirigir al inicio de sesión si no hay sesión activa
    exit();
}

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "banco");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Definir variables con valor por defecto
$username = "";
$email = "";
$saldo = "";

// Obtener la información del usuario usando la sesión de correo
$email_session = $_SESSION['email'];
$query = "SELECT * FROM usuarios WHERE email = '$email_session'";
$result = $conn->query($query);

// Verificar si se obtuvo información del usuario
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['nombre']; // Cambiado a 'nombre' ya que no hay 'username' en tu estructura
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
    header("Location: login.php");
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi cuenta</title>
  <link rel="stylesheet" href="estilos2.css">
</head>
<body>
  <div class="contenedor">
    <h2>Mi cuenta</h2>
    <p>Información del usuario</p>
    <div class="informacion-usuario">
      <p>Nombre de usuario: <?php echo htmlspecialchars($username); ?></p>
      <p>Email: <?php echo htmlspecialchars($email); ?></p>
    </div>
    <p>Información de la cuenta</p>
    <div class="informacion-cuenta">
      <p>Saldo: $<?php echo htmlspecialchars($saldo); ?></p>
    </div>
    
    <a href="traferencia.html">realicar traferencia</a>
  </div>
</body>
</html>