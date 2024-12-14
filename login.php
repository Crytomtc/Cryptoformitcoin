<?php
session_start(); // Iniciar la sesión para poder almacenar el usuario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $archivo = '736373673636/725392627263.txt';

    if (file_exists($archivo)) {
        $usuarios = file($archivo, FILE_IGNORE_NEW_LINES);

        foreach ($usuarios as $linea) {
            list($u, $p) = explode(" ", $linea);
            if ($u == $usuario && $p == $contraseña) {
                // Almacenar el usuario y su ID en la sesión
                $_SESSION['usuario'] = $usuario;
                
                // Obtener el ID del usuario
                $archivoIDs = '638263836/82628262.txt';
                if (file_exists($archivoIDs)) {
                    $ids = file($archivoIDs, FILE_IGNORE_NEW_LINES);
                    foreach ($ids as $linea) {
                        list($u, $id) = explode(" ", $linea);
                        if ($u == $usuario) {
                            $_SESSION['id'] = $id; // Almacenar el ID en la sesión
                            break;
                        }
                    }
                }

                // Redirigir al menú
                header("Location: menu.html");
                exit();
            }
        }
        echo "Usuario o contraseña incorrectos.";
    } else {
        echo "No se ha encontrado el archivo de usuarios.";
    }
}
?>
