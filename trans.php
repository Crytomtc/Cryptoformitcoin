<?php
session_start();

// Archivos de datos
$archivoIDs = '638263836/82628262.txt'; // Archivo con usuarios e IDs
$archivoSaldos = '02628262/628252827.txt'; // Archivo con usuarios y saldos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    die("Acceso denegado: Inicia sesión.");
}

$usuario = $_SESSION['usuario']; // Usuario actual
$destinoID = $_POST['destination-id']; // ID de destino
$monto = floatval($_POST['amount']); // Monto a transferir

// Leer archivos
$lineasIDs = file($archivoIDs, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$lineasSaldos = file($archivoSaldos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (!$lineasIDs || !$lineasSaldos) {
    die("Error: No se pudo leer los archivos necesarios.");
}

// Buscar el ID del usuario actual
$usuarioID = null;
foreach ($lineasIDs as $linea) {
    list($user, $id) = explode(' ', $linea);
    if ($user === $usuario) {
        $usuarioID = $id;
        break;
    }
}
if (!$usuarioID) {
    die("Error: Usuario no encontrado en el archivo de IDs.");
}

// Buscar el usuario destino a partir del ID
$destinoUsuario = null;
foreach ($lineasIDs as $linea) {
    list($user, $id) = explode(' ', $linea);
    if ($id === $destinoID) {
        $destinoUsuario = $user;
        break;
    }
}
if (!$destinoUsuario) {
    die("Error: Usuario destino no encontrado.");
}

// Verificar saldo del usuario actual
$saldoUsuario = null;
foreach ($lineasSaldos as $linea) {
    list($user, $saldo) = explode(' ', $linea);
    if ($user === $usuario) {
        $saldoUsuario = floatval($saldo);
        if ($saldoUsuario < $monto) {
            die("Error: Saldo insuficiente."); // Terminar sin modificar nada
        }
        break;
    }
}
if ($saldoUsuario === null) {
    die("Error: Usuario actual no encontrado en el archivo de saldos.");
}

// Descontar saldo del usuario actual y actualizar saldos
foreach ($lineasSaldos as &$linea) {
    list($user, $saldo) = explode(' ', $linea);
    if ($user === $usuario) {
        $nuevoSaldoUsuario = $saldoUsuario - $monto;
        $linea = "$user $nuevoSaldoUsuario";
    } elseif ($user === $destinoUsuario) {
        $nuevoSaldoDestino = floatval($saldo) + $monto;
        $linea = "$user $nuevoSaldoDestino";
    }
}

// Guardar los saldos actualizados
if (!file_put_contents($archivoSaldos, implode("\n", $lineasSaldos))) {
    die("Error: No se pudo actualizar el archivo de saldos.");
}

// Respuesta de éxito
echo "Transferencia realizada correctamente.";
?>
