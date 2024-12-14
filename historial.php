<?php
session_start();

$usuario = $_SESSION['usuario'];  // El nombre de usuario se obtiene de la sesión

// Archivos donde se almacenan las transacciones de los usuarios
$archivoRecibidos = '725282626262/recibidos_' . $usuario . '.txt';
$archivoEnviados = '725282626262/enviados_' . $usuario . '.txt';

$transacciones = [];

// Leer las transacciones recibidas
if (file_exists($archivoRecibidos)) {
    $recibidos = file($archivoRecibidos, FILE_IGNORE_NEW_LINES);
    foreach ($recibidos as $transaccion) {
        list($id, $cantidad, $timestamp) = explode(' ', $transaccion);
        $transacciones[] = [
            'tipo' => 'recibido',
            'id' => $id,
            'cantidad' => $cantidad,
            'timestamp' => $timestamp
        ];
    }
}

// Leer las transacciones enviadas
if (file_exists($archivoEnviados)) {
    $enviados = file($archivoEnviados, FILE_IGNORE_NEW_LINES);
    foreach ($enviados as $transaccion) {
        list($id, $cantidad, $timestamp) = explode(' ', $transaccion);
        $transacciones[] = [
            'tipo' => 'enviado',
            'id' => $id,
            'cantidad' => $cantidad,
            'timestamp' => $timestamp
        ];
    }
}

// Ordenar las transacciones por el timestamp (más reciente primero)
usort($transacciones, function ($a, $b) {
    return $b['timestamp'] <=> $a['timestamp'];  // Orden descendente por timestamp
});

// Mostrar las transacciones en el formato solicitado
foreach ($transacciones as $transaccion) {
    if ($transaccion['tipo'] == 'recibido') {
        echo "<p>Has recibido {$transaccion['cantidad']} MTC del ID {$transaccion['id']}</p>";
    } elseif ($transaccion['tipo'] == 'enviado') {
        echo "<p>Has enviado {$transaccion['cantidad']} MTC al ID {$transaccion['id']}</p>";
    }
}
?>
