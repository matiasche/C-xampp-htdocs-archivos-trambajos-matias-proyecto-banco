<?php

session_start();
require 'config.php'; // Conexión a la base de datos

$error_message = "";

//  comprobamos que el usuario alla inicidado sesion
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirigir al inicio de sesión si no hay sesión activa
    exit();
}

// Definir variables con valor por defecto
$username = "";
$email = "";
$saldo = "";

// usamos la conecion del gmail para estrar los datos de los usuarios
$email_session = $_SESSION['email'];
$query = "SELECT * FROM usuarios WHERE email = '$email_session'";
$result = $conn->query($query);

// Verificar si se obtuvo información del usuario
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['nombre']; 
    $email = $row['email'];

    // Obtener la información de la cuenta asociada al usuario
    $query = "SELECT * FROM cuentas WHERE id_usuario = '$row[id_usuario]'";
    $result = $conn->query($query);

    // comprobabos que se alla obtenido la informacion de la cuenta del usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $saldo = $row['saldo'];
    }
} else {
    // si no se sencuetra el usario se enviara al login para poder iniciar cecion 
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
<link rel="stylesheet" href="css/estilos2.css">
  <title>Mi cuenta</title>

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