var pilgan = document.getElementById("total_pilgan").value;
var essay = document.getElementById("total_essay").value;

var pie_chart = document.getElementById("pie_chart").getContext('2d');

// For a pie chart
var myPieChart = new Chart(pie_chart, {
    type: 'pie',
    data: data = {
        datasets: [{
            data: [pilgan, essay],

            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        }],
    
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Pilihan ganda',
            'Essay'
        ],


    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});