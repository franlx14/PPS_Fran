<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Comentario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body >

    <form action="./guardar_comentario.php" method="post">
        <table align="center" style="margin-top: 8%;"  class="body3">
            <tr>
                <td class="texto2">Comentario a Añadir</td>
            </tr>
            <tr>
                <td>
                    <textarea name="comentario" id="comentario" rows="12" cols="48" style="border-radius: 8px;"></textarea>
                </td>
            </tr>
            <tr>
                <td><button type="submit">ENVIAR</button></td>
            </tr>
        </table>
    </form>
    
</body>
</html>