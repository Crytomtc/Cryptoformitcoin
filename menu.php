<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html"); // Si no está logueado, redirigir a la página de inicio
    exit();
}

// Obtener el usuario actual
$usuario = $_SESSION['usuario'];

// Ruta de archivos donde se almacenan los datos de los usuarios
$archivoSaldos = '02628262/628252827.txt';
$archivoIDs = '638263836/82628262.txt';

// Función para obtener el ID del usuario
function obtenerUsuarioID($usuario, $archivoIDs) {
    // Leer el archivo con los IDs
    $lineas = file($archivoIDs, FILE_IGNORE_NEW_LINES);
    foreach ($lineas as $linea) {
        list($nombre, $id) = explode(" ", $linea);
        if ($nombre == $usuario) {
            return $id; // Si el nombre de usuario coincide, devolver el ID
        }
    }
    return null; // Si no se encuentra el usuario, devolver null
}

// Función para obtener el saldo del usuario
function obtenerSaldoUsuario($usuario, $archivoSaldos) {
    // Leer los saldos
    $lineas = file($archivoSaldos, FILE_IGNORE_NEW_LINES);
    foreach ($lineas as $linea) {
        list($user, $saldo) = explode(" ", $linea);
        if ($user == $usuario) {
            return $saldo; // Si el usuario coincide, devolver el saldo
        }
    }
    return 0; // Si no se encuentra el usuario, devolver saldo 0
}

// Obtener el ID y saldo del usuario
$idUsuario = obtenerUsuarioID($usuario, $archivoIDs);
$saldoUsuario = obtenerSaldoUsuario($usuario, $archivoSaldos);

// Si no se encuentra el ID o saldo del usuario, redirigir a index.html
if ($idUsuario === null) {
    header("Location: index.html");
    exit();
}

// Devolver los datos como JSON
$data = array(
    'usuario' => $usuario,
    'id' => $idUsuario,
    'saldo' => $saldoUsuario
);

// Salir del script PHP para evitar que se muestre cualquier HTML antes de procesar
echo json_encode($data);
exit();
?>
