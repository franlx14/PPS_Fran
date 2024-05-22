<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobar User</title>
</head>
<body>

<?php
require_once './conexion_bd.php';

// Conexión a la base de datos
$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Conexion fallida: " . mysqli_connect_error();
    exit();
}

mysqli_select_db($conexion, $db_database);

// Recibir datos del formulario
$usuario = htmlspecialchars(mysqli_real_escape_string($conexion, $_POST['user']));
$passwd = $_POST['pass'];

// Buscar el usuario en la base de datos
$consulta = "SELECT usuario, passwd FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    echo mysqli_error($conexion);
    exit();
}

$datos = mysqli_fetch_assoc($resultado);

// Verifica si se han enviado datos del formulario
if ($datos) {
    // Verificar la contraseña
    if (password_verify($passwd, $datos['passwd'])) {
        // Contraseña válida, iniciar sesión
        $_SESSION['usuario'] = $datos['usuario'];
        
        // Redirigir a la página index.php
        echo "<script>window.location.href = 'index.php';</script>";
        exit(); // Asegura que el script se detenga después de redirigir
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta. Por favor, intenta de nuevo.";
    }
} else {
    // Usuario no encontrado
    echo "Usuario no encontrado. Por favor, registra una cuenta.";
}

?>

    
</body>
</html>