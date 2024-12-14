<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Archivos donde se almacenarán los datos
    $archivoUsuarios = '736373673636/725392627263.txt';
    $archivoIDs = '638263836/82628262.txt';
    $archivoSaldos = '02628262/628252827.txt';

    // Comprobar si el archivo de usuarios existe y leerlo
    if (file_exists($archivoUsuarios)) {
        $usuarios = file($archivoUsuarios, FILE_IGNORE_NEW_LINES);
        foreach ($usuarios as $linea) {
            list($u, $p) = explode(" ", $linea);
            if ($u == $usuario) {
                echo "El usuario ya está registrado.";
                exit();
            }
        }
    }

    // Generar un ID aleatorio único entre 8 y 25 dígitos
    do {
        $id = generateRandomId(8, 25);  // Genera un ID aleatorio entre 8 y 25 dígitos
    } while (userIdExists($id, $archivoIDs));  // Verifica que el ID no exista ya

    // Generar saldo inicial (0)
    $saldo = 0;

    // Guardar el nuevo usuario, ID y saldo en los archivos correspondientes
    file_put_contents($archivoUsuarios, $usuario . " " . $contraseña . "\n", FILE_APPEND);
    file_put_contents($archivoIDs, $usuario . " " . $id . "\n", FILE_APPEND);
    file_put_contents($archivoSaldos, $usuario . " " . $saldo . "\n", FILE_APPEND);

    echo "Usuario registrado exitosamente. Ahora puedes iniciar sesión.";
}

// Función para verificar si un ID ya existe
function userIdExists($id, $archivo) {
    if (file_exists($archivo)) {
        $lineas = file($archivo, FILE_IGNORE_NEW_LINES);
        foreach ($lineas as $linea) {
            list($usuario, $idExistente) = explode(" ", $linea);
            if ($idExistente == $id) {
                return true;  // ID ya existe
            }
        }
    }
    return false;  // ID no existe
}

// Función para generar un ID aleatorio con una longitud entre $min y $max dígitos
function generateRandomId($min, $max) {
    $length = rand($min, $max);  // Genera un número de longitud aleatoria entre $min y $max
    $id = '';
    for ($i = 0; $i < $length; $i++) {
        $id .= rand(0, 9);  // Agregar un dígito aleatorio
    }
    return $id;
}
?>
