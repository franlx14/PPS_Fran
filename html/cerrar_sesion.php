<?php
session_start(); // Inicia la sesión ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesion</title>
</head>
<body>

<?php

// Verifica si la variable de sesión 'usuario' está definida y la destruye
if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']); // Destruye la variable de sesión 'usuario'
}

// Redirige al usuario a la página principal (index.php)
echo "<script>window.location.href = 'index.php';</script>";
exit(); // Asegura que el script se detenga aquí
?>

    
</body>
</html>