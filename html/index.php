<?php session_start();
error_reporting(E_ALL); ini_set('display_errors', 1); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./estilos.css">
    <link rel="shortcut icon" href="./materiales/icono.png" type="image/x-icon">
</head>
<body class="body">

        <?php
        require_once './conexion_bd.php';

        try {
            $conexion = new PDO("mysql:host=$db_hostname;dbname=$db_database", $db_username, $db_password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if (isset($_SESSION['usuario'])) {
                $usuario = $_SESSION['usuario'];
                $consulta = "SELECT * FROM usuarios WHERE usuario = :usuario";
                $statement = $conexion->prepare($consulta);
                $statement->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                $statement->execute();
                $datos = $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                $usuario = 0;
            }
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
        ?>


    <div class="left-div">
        <!-- Contenido del div izquierdo -->
        <table width="100%" style="background-color: #F1C40F; margin-top:2%; margin-buttom: 2%; border-radius: 10px;">
            <tr>
                <td width="40%"><img src="./materiales/icono.png" alt="Icon_Blog" width="45%" /></td>
                <td align="left"><h2>Prado's Blog</h2></td>
            </tr>
        </table>
        <br>

        <table width="100%" style="font-size: 20px; height: 16px; background-color: #A569BD; color: white; padding-left: 2%; margin-top:2%; margin-bottom: 2%; border-radius: 10px;">
            <tr>
                <td align="left"><button onclick="cargarPagina('contenido.html')" style="background-color: transparent;border: 0px; font-size: 18px; color: white;">INICIO</button></td>
            </tr>
        </table>

        <table width="100%" style="font-size: 20px; height: 16px; background-color: green; color: white; padding-left: 2%; margin-top:2%; margin-bottom: 2%; border-radius: 10px;">
            <tr>
                <td align="left"><button onclick="cargarPagina('blog.php')" style="background-color: transparent;border: 0px; font-size: 18px; color: white;">BLOG</button></td>
            </tr>
        </table>

        <table width="100%" style="font-size: 20px; height: 16px; background-color: #5499C7; color: white; padding-left: 2%; margin-top:2%; margin-bottom: 2%; border-radius: 10px;">
            <tr>
                <td align="left"><button onclick="cargarPagina('fotos.php')" style="background-color: transparent;border: 0px; font-size: 18px; color: white;">FOTOS</button></td>
            </tr>
        </table>

        <?php
        if ($usuario == 0) {
            echo '
            <table width="100%" style="font-size: 20px; height: 16px; background-color: red; color: white; padding-left: 2%; margin-top:2%; margin-bottom: 2%; border-radius: 10px;">
            <tr>
                <td align="left"><a href="./iniciar_sesion.html" style="color: white; text-decoration: none;">ENTRAR</a></td>
            </tr>
            </table>

            <table width="100%" style="font-size: 20px; height: 16px; background-color: #FFC300; color: white; padding-left: 2%; margin-top:2%; margin-bottom: 2%; border-radius: 10px;">
                <tr>
                    <td align="left"><button onclick="cargarPagina(\'registro.html\')" style="background-color: transparent;border: 0px; font-size: 18px; color: white;">REGISTRO</button></td>
                </tr>
            </table>';
        }
        ?>


        <?php

            if ($usuario != 0){
            echo '<table width="100%" style="font-size: 20px; height: 16px; background-color: #E74C3C; color: white; padding-left: 2%; margin-top:2%; margin-bottom: 2%; border-radius: 10px;">
            <tr>
                <td align="left"><a href="./cerrar_sesion.php" style="color: white; text-decoration: none;">SALIR</a></td>
            </tr>
            </table>';
            }

        ?>
        
        <br>

            <?php
            if ($usuario != 0) {
                echo '
                <table width="100%" style="font-size: 20px; height: 16px; background-color: purple; color: white; padding-left: 2%; padding-right: 2%; padding-top: 5%; padding-bottom: 5%; margin-top:2%; margin-bottom: 2%; border-radius: 4px;">
                    <tr>
                        <td colspan="2" width="10%" align="left"> Datos del Usuari@</td>
                    </tr>
                    <tr>
                        <td align="center"><img src="./materiales/usuario.png" alt="Usuario" width="78%" /></td>
                        <td><p>' . $datos['nombre'] . ' &nbsp; &nbsp; Usuario: ' . $datos['usuario'] . '</p></td>
                    </tr>
                    <tr>
                        <td align="center"><img src="./materiales/correo.png" alt="Correo" width="58%" /></td>
                        <td><p>Correo: ' . $datos['correo'] . '</p></td>
                    </tr>
                </table>';
            }
            ?>
            
            <script>
                    function cargarPagina(url) {
                        document.getElementById("pagina").src = url;
                    }
                </script>


    <br>
    </div>
    <div class="right-div" id="carga" name="carga">
        <!-- Contenido del div derecho -->
        <iframe id="pagina" src="contenido.html" width="100%" height="670" frameborder="0"></iframe>
    </div>
    <div class="clearfix"></div>
    
</body>
</html>