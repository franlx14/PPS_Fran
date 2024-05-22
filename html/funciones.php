<?php

class Funciones{   // Función para validar usuario
    public static function validarusuario($usuario) {
    // Normalizar el usuario (eliminar espacios y convertir a mayúsculas)
    $usuario = strtoupper(trim($usuario));
    
    // Verificar el formato del usuario (debe tener 8 dígitos seguidos de una letra)
    if (!preg_match('/^[0-9]{8}[A-Z]$/', $usuario)) {
        return false;
    }
    
    // Extraer el número y la letra del usuario
    $numero = substr($usuario, 0, 8);
    $letra = substr($usuario, 8);
    
    // Calcular la letra esperada para el número de usuario
    $letrasValidas = 'TRWAGMYFPDXBNJZSQVHLCKE';
    $indice = $numero % 23;
    $letraEsperada = $letrasValidas[$indice];
    
    // Comparar la letra esperada con la letra proporcionada
    return ($letra === $letraEsperada);
}

}


?>