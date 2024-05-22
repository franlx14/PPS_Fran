<?php session_start(); ?>
<!DOCTYPE html>
<?php 
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    }
    else{
        $usuario = 0;
    }
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotografias</title>
    <link rel="stylesheet" href="./estilos.css">
</head>
<body class="contenido">
    <?php
    if ($usuario !=0){
        echo '<p style="text-align: right;"><a href="subir_foto.php" style="background-color: purple; color: white; text-decoration: none; padding-left: 2%; padding-right: 2%; font-size: 24px; border-radius: 10px;">Subir Foto</a></p>';
    }
    ?>
<?php

    require_once './conexion_bd.php';
    $conexion = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
    if (mysqli_connect_errno())
    {
        echo "Conexion fallida: ". mysqli_connect_error();
        exit();
    }
    mysqli_select_db ($conexion,$db_database);

    $consulta = "SELECT fotos.foto as fotob,titulo,nombre,fecha from fotos,usuarios where usuarios.usuario=fotos.usuario";
    $resultado = mysqli_query($conexion,$consulta);
    if (!$resultado) {
        echo mysqli_error($conexion);
    }
?>

    <div style="display: flex; flex-wrap: wrap;">
        <?php
            while ($datos = mysqli_fetch_assoc($resultado)){
                echo '<div class="div3">';
                echo '<img style="width: 100%; height: 200px; margin-top: -2.6%; border-radius: 10px;" src="data:image/jpeg;base64,'.base64_encode($datos['fotob']) .'" alt="foto"/>';
                echo '<br><b>Titulo:</b> '.$datos['titulo'].'';
                echo '<br><b>Usuari@:</b> '.$datos['nombre'].'';
                echo '<br><b>Fecha:</b> '.$datos['fecha'].'';
                echo '</div>';
            }
        ?>
    </div>
    
</body>
</html>