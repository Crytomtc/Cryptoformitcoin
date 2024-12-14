<?php
session_start();

$usuario = $_SESSION['usuario'];  // El nombre de usuario se obtiene de la sesión

// Ruta del archivo donde se almacenan los picos comprados
$archivoInventario = '725282626262/inventario_' . $usuario . '.txt';

if (file_exists($archivoInventario)) {
    $picos = file($archivoInventario, FILE_IGNORE_NEW_LINES);
} else {
    $picos = ['free.png']; // Pico por defecto (si no hay picos comprados)
}

// Mostrar los picos en el inventario
foreach ($picos as $pico) {
    echo "<div class='pickaxe-item'>
            <img src='assets/$pico' alt='Pico'>
            <p>Velocidad de minería: " . getMiningSpeed($pico) . "</p>
            <button>Usar</button>
          </div>";
}

// Función para obtener la velocidad de minería según el pico
function getMiningSpeed($pico) {
    switch ($pico) {
        case '1.png':
            return '1 moneda cada 45 minutos';
        case '2.png':
            return '1 moneda cada 30 minutos';
        case '3.png':
            return '1 moneda cada 1 minuto';
        case '4.png':
            return '1 moneda por segundo';
        default:
            return '1 moneda cada 60 minutos';
    }
}
?>
