// Diagram Lingkaran 1
new Chart(document.getElementById('chart1'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [95, 5],
            backgroundColor: ['#1cc88a', '#e0e0e0']
        }]
    },
    options: {
        cutout: '80%',
        plugins: { legend: { display: false } }
    }
});

// Diagram Lingkaran 2
new Chart(document.getElementById('chart2'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [92, 8],
            backgroundColor: ['#f6c23e', '#e0e0e0']
        }]
    },
    options: {
        cutout: '80%',
        plugins: { legend: { display: false } }
    }
});

// Diagram Lingkaran 3
new Chart(document.getElementById('chart3'), {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [95, 5],
            backgroundColor: ['#e74a3b', '#e0e0e0']
        }]
    },
    options: {
        cutout: '80%',
        plugins: { legend: { display: false } }
    }
});

// Grafik Garis
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Verifikasi',
            data: [10, 15, 20, 12, 18, 25, 22, 30, 28, 35, 40, 38],
            borderColor: '#224abe',
            fill: true,
            backgroundColor: 'rgba(78, 115, 223, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});

// DataTable
$(document).ready(function() {
    $('#dataTable').DataTable({
        paging: false,
        searching: false,
        info: false,
        ordering: false
    });
});