document.addEventListener("DOMContentLoaded", () => {
    // Elemento del menú
    const menu = document.getElementById('menu');
    
    // Elementos del menú como un arreglo
    const menuItems = [
        { text: 'Inicio', link: 'menu.php' },
        { text: 'Tienda', link: 'store.html' },
        { text: 'Historial', link: 'historia.html' },
        { text: 'Transferir', link: 'trans.html' },
        { text: 'Inventario', link: 'inven.html' }
    ];

    // Agregar los enlaces al menú
    menuItems.forEach(item => {
        const a = document.createElement('a');
        a.href = item.link;
        a.textContent = item.text;
        menu.appendChild(a);
    });

    // Menu Toggle (hamburguesa)
    const menuToggle = document.querySelector('.menu-toggle');
    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('active');
    });

    // Inicialización de gráficos (puedes usar cualquier librería como Chart.js o similar)
    const ctx1 = document.getElementById('grafico1').getContext('2d');
    const ctx2 = document.getElementById('grafico2').getContext('2d');
    
    new Chart(ctx1, {
        type: 'line', // o 'bar', 'pie', etc.
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
            datasets: [{
                label: 'Actividad 1',
                data: [5, 10, 15, 20],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            }]
        }
    });

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
            datasets: [{
                label: 'Actividad 2',
                data: [3, 8, 12, 18],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        }
    });
});
