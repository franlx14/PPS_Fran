
<?php
require_once '/home/runner/work/PPS_Fran/PPS_Fran/html/funciones.php';
use PHPUnit\Framework\TestCase;

class funcionesTest extends TestCase
{
    /**
     * @dataProvider usuarioProvider
     */
    public function testValidarUsuario($input, $expected)
    {
        $this->assertEquals($expected, Funciones::validarusuario($input));
    }

    public function usuarioProvider()
    {
        return [
            ["12345678Z", true],
            ["12345678X", false],
            ["87654321T", false],
            ["87654321A", false],
            ["00000000T", true],
            ["00000000X", false],
            ["99999999R", true],
            ["26512752P", true],
            ["123456789", false],  // Demasiados dígitos
            ["ABCDEFGHX", false],  // Formato incorrecto
            ["1234 5678Z", false],  // Espacios que se eliminan
            ["12345678Z ", true], // Espacios antes y después
            [" 87654321t", false],  // Minúsculas convertidas a mayúsculas
        ];
    }
}
?>

