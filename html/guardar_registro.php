<?php
session_start();
require_once './conexion_bd.php';

// Función para validar usuario
    require_once 'funciones.php';

    // Definir el usuario que quieres validar
    $usuario = '12345678A';  // Reemplaza esto con el usuario que quieres validar

    // Llamar a la función validarusuario de la clase UsuarioValidator y obtener el resultado
    $esValido = Funciones::validarusuario($usuario);

    // Mostrar el resultado
    if ($esValido) {
        echo "El usuario $usuario es válido.";
    } else {
        echo "El usuario $usuario no es válido.";
    }

// Conexión a la base de datos
$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Conexion fallida: " . mysqli_connect_error();
    exit();
}

mysqli_select_db($conexion, $db_database);

// Recibir y sanitizar datos del formulario
$usuario = htmlspecialchars(mysqli_real_escape_string($conexion, $_POST['usuario']));
$passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT); // Encriptar la contraseña
$nombre = htmlspecialchars(mysqli_real_escape_string($conexion, $_POST['nombre']));
$correo = htmlspecialchars(mysqli_real_escape_string($conexion, $_POST['correo']));
$usuario = $_POST['usuario'];

// Validar el usuario
if (!validarusuario($usuario)) {
    echo "Error: El DNI proporcionado no es válido.";
    exit();
}

// Procesar la foto (si se envió)
$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

// Consulta para verificar si el usuario ya existe
$consulta = "SELECT COUNT(id) AS cuenta FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conexion, $consulta);

if (!$resultado) {
    echo mysqli_error($conexion);
    exit();
}

$datos = mysqli_fetch_assoc($resultado);

// Verificar si el usuario ya existe antes de insertar
if ($datos['cuenta'] == 0) {
    $sql = "INSERT INTO usuarios (usuario, passwd, nombre, correo, foto) VALUES ('$usuario', '$passwd', '$nombre', '$correo', '$foto')";
    
    if ($conexion->query($sql) === TRUE) {
        echo "Registro exitoso, ya puede iniciar sesión!";
    }
} else {
    echo "Error: El usuario no ha sido añadido o ya existe, ¡inténtelo de nuevo!";
}

?>

