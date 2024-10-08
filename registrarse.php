<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/estilos.css">
  <title>Registro de usuario</title>
</head>
<body>
  <div class="contenedor">
    <div class="imagen-formulario"></div>
    <div class="formulario">
      <div class="texto-formulario">
        <h2>Registro de usuario</h2>
        <p>Ingrese sus datos para registrarse</p>
      </div>
      <form action="controlador_registro.php" method="post">
        <div class="input">
          <label for="username">Nombre de usuario </label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="input">
          <label for="password">contraseña:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="input">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <input type="submit" value="Registrar">
      </form>
    </div>
  </div>
</body>
</html>







