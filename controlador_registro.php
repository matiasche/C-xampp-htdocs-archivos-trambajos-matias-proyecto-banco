<?php
  // Define the variables
  $localhost = "localhost";
  $banco = "banco";
  $username = "root";
  $password = "";

  // Create a new mysqli object
  $conn = new mysqli($localhost, $username, $password, $banco);

  // Check connection
  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  // Check if form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST["username"];
    $new_password = $_POST["password"];
    $new_email = $_POST["email"];

    // Hash the password for security
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

 // Insert new user
$sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$new_username', '$new_email', '$hashed_password')";
if ($conn->query($sql) === TRUE) {
  $new_user_id = $conn->insert_id; // Get the ID of the newly inserted user

  // Insert new account for the user
  $sql = "INSERT INTO cuentas (saldo, id_usuario) VALUES (20000, $new_user_id)";
  if ($conn->query($sql) === TRUE) {
    header(header: "Location: login.html ");
    exit();

  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

  }
  // After successful registration

  $conn->close();
?>