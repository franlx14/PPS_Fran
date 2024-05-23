<?php
session_start();
require_once './conexion_bd.php';
require_once 'funciones.php';

// Conexión a la base de datos
$conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Conexión fallida: " . mysqli_connect_error();
    exit();
}

// Verificar que los datos se han enviado correctamente
if (isset($_POST['usuario'], $_POST['passwd'], $_POST['nombre'], $_POST['correo'], $_FILES['foto']['tmp_name'])) {
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT); // Encriptar la contraseña
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

    // Validar el usuario
    if (!Funciones::validarusuario($usuario)) {
        echo "Error: El DNI proporcionado no es válido.";
        exit();
    }

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
        } else {
            echo "Error: " . $conexion->error;
        }
    } else {
        echo "Error: El usuario ya existe, ¡inténtelo de nuevo!";
    }
} else {
    echo "Error: Datos incompletos.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>

