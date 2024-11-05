import { fetchMonthlyTrips } from './main.js';

export async function drawChart(ctx) {
    const tripData = await fetchMonthlyTrips();

    // Procesa los datos para Chart.js
    const labels = tripData.map(row => `${row.mes}-${row.año}`);
    const data = tripData.map(row => row.total_viajes);

    // Configura y dibuja el gráfico
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total de Viajes',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Número de Viajes'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Mes-Año'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
}
