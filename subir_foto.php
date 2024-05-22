<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="./estilos.css">
</head>
<body class="body3">
    
    <form action="guardar_foto.php" method="post" enctype="multipart/form-data" style="background-color: wheat; border-radius: 20px; padding-left: 4%;">
    <br><h2>Subir foto nueva</h2> 
        <label for="titulo">Título:</label><br>
        <textarea id="titulo" name="titulo" required></textarea><br><br>
        
        <label for="foto">Foto:</label><br>
        <input type="file" id="foto" name="foto" accept="image/*" required><br><br>
        
        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha" required><br><br>
        
        <input type="submit" value="Enviar">
        <br><br>
    </form>
</body>
</html>
