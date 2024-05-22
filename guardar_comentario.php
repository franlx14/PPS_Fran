<?php
session_start();
require_once './conexion_bd.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    echo "Error: Usuario no autenticado.";
    exit();
}

// Usuario obtenido de la variable de sesión
$usuario = $_SESSION['usuario'];

// Conexión a la base de datos
$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Conexion fallida: " . mysqli_connect_error();
    exit();
}

mysqli_select_db($conexion, $db_database);

// Recibir y sanitizar datos del formulario
$comentario = htmlspecialchars(mysqli_real_escape_string($conexion, $_POST['comentario']));
$color = $_POST['color'];

// Consulta para insertar los datos en la base de datos
$sql = "INSERT INTO comentarios (usuario, fecha, comentario, color) VALUES ('$usuario', curdate(), '$comentario', '$color')";

// Ejecutar la consulta
if ($conexion->query($sql) === TRUE) {
    header("Location: blog.php");
    exit(); // Asegura que el script se detenga después de redirigir
} else {
    echo "Error al guardar el comentario, intentalo de nuevo.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
