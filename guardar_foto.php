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
$titulo = htmlspecialchars(mysqli_real_escape_string($conexion, $_POST['titulo']));
$fecha = $_POST['fecha'];

// Procesar la foto (si se envió)
if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
} else {
    echo "Error al subir la foto.";
    exit();
}

// Consulta para insertar los datos en la base de datos
$sql = "INSERT INTO fotos (usuario, titulo, foto, fecha) VALUES ('$usuario', '$titulo', '$foto', '$fecha')";

// Ejecutar la consulta
if ($conexion->query($sql) === TRUE) {
    // Redirigir a la página index.php
    header("Location: fotos.php");
    exit(); // Asegura que el script se detenga después de redirigir
} else {
    echo "Error al guardar la foto, intentalo de nuevo!";
}

// Cerrar conexión
mysqli_close($conexion);
?>
