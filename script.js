// Abrir y cerrar menú lateral
document.getElementById('menu-toggle').addEventListener('click', function () {
    var menu = document.getElementById('menu');
    if (menu.style.left === "0px") {
        menu.style.left = "-250px";
    } else {
        menu.style.left = "0";
    }
});

// Función para iniciar el proceso de minería
document.getElementById('mine-button').addEventListener('click', function () {
    var saldo = parseInt(document.getElementById('user-saldo').innerText);
    var velocidad = getMiningSpeed();
    var tiempoRestante = getMiningTime(velocidad);
    startMining(saldo, velocidad, tiempoRestante);
});

// Función para calcular la velocidad de minería (basado en el pico seleccionado)
function getMiningSpeed() {
    return 60; // Por defecto, una moneda cada 60 minutos
}

// Función para obtener el tiempo restante de minería
function getMiningTime(velocidad) {
    return velocidad; // Por ejemplo, 60 minutos
}

// Simula el proceso de minería
function startMining(saldo, velocidad, tiempoRestante) {
    var progressBar = document.getElementById('mining-progress-bar');
    var miningTime = tiempoRestante * 60; // Convertir a segundos
    var progress = 0;

    var interval = setInterval(function () {
        if (progress >= 100) {
            clearInterval(interval);
            saldo += 1; // Aumentar saldo en 1 moneda
            document.getElementById('user-saldo').innerText = saldo;
            document.getElementById('mining-progress-bar').value = 0;
            alert("¡Minería completada! Has ganado 1 moneda.");
        } else {
            progress += (100 / miningTime);
            progressBar.value = progress;
        }
    }, 1000); // Actualiza cada segundo
}
