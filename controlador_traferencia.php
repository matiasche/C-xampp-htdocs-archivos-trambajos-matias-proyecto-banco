<?php
  // Define the variables
  $localhost = "localhost";
  $banco = "banco";
  $username = "root";
  $password = "";

  // Create a new mysqli object
  $conn = new mysqli($localhost, $username, $password, $banco);

  // Verificar conexión
  if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
  }

  // Función para realizar transferencia
  function realizarTransferencia($id_remitente, $id_cuentadestino, $cantidad) {
    global $conn;

    // Verificar si la cuenta del remitente tiene saldo suficiente
    $query = "SELECT saldo FROM cuentas WHERE id_cuenta = '$id_remitente'";
    $result = $conn->query($query);
    $saldo_remitente = $result->fetch_assoc()['saldo'];

    if ($saldo_remitente >= $cantidad) {
      // Realizar transferencia
      $query = "INSERT INTO transferencias (cantidad, id_remitente, id_cuentadestino) VALUES ('$cantidad', '$id_remitente', '$id_cuentadestino')";
      $conn->query($query);

      // Actualizar saldo de la cuenta del remitente
      $query = "UPDATE cuentas SET saldo = saldo - '$cantidad' WHERE id_cuenta = '$id_remitente'";
      $conn->query($query);

      // Actualizar saldo de la cuenta del destinatario
      $query = "UPDATE cuentas SET saldo = saldo + '$cantidad' WHERE id_cuenta = '$id_cuentadestino'";
      $conn->query($query);

      return true;
    } else {
      return false;
    }
  }

  // Procesar formulario
  if (isset($_POST['submit'])) {
    $id_remitente = $_POST['id_remitente'];
    $id_cuentadestino = $_POST['id_cuentadestino'];
    $cantidad = $_POST['cantidad'];

    if (realizarTransferencia($id_remitente, $id_cuentadestino, $cantidad)) {
      echo "Transferencia realizada con éxito";
    } else {
      echo "No hay saldo suficiente en la cuenta del remitente";
    }
  }

  // Cerrar conexión
  $conn->close();
?>