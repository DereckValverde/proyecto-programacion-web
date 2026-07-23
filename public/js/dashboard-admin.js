//Gráfico de Líneas (Histórico)
const chartLine = document.getElementById('lineChart').getContext('2d');
new Chart(chartLine, {
    type: 'line',
    data: {
        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
        datasets: [{
            label: 'Equipos Recibidos',
            data: [12, 19, 32, 45, 82, 82],
            borderColor: '#0092a5',
            tension: 0.3,
            fill: true,
            backgroundColor: 'rgba(6, 219, 247, 0.1)'
        }]
    }
});

// Gráfico de Área (Tipos de Equipos Donados)
const chartArea = document.getElementById('chartArea').getContext('2d');

const etiquetasEquipos = ['Laptos', 'Monitores', 'Teclados', 'Impresoras', 'Mouse'];

new Chart(chartArea, {
    type: 'pie',
    data: {
        labels: etiquetasEquipos,
        datasets: [
            {
                label: 'Equipos Donados',
                data: [25, 65, 77, 11, 33],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 205, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(54, 162, 235, 0.7)'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: 'center'
            }
        }
    }
});