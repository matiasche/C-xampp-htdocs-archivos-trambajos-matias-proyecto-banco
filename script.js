const username = document.getElementById('username');
const email = document.getElementById('email');
const fechaRegistro = document.getElementById('fecha-registro');
const saldo = document.getElementById('saldo');

// Mostrar la información del usuario
username.textContent = '<?php echo $username; ?>';
email.textContent = '<?php echo $email; ?>';
fechaRegistro.textContent = '<?php echo $fecha_registro; ?>';
saldo.textContent = '<?php echo $saldo; ?>';