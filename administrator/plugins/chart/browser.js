var Chrome = document.getElementById("Chrome").value;
var Mozila = document.getElementById("Mozila").value;
var Opera = document.getElementById("Opera").value;
var Safari = document.getElementById("Safari").value;
var Explore = document.getElementById("Explore").value;

var ctx = document.getElementById('browser').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Chrome', 'Mozila', 'Opera', 'Safari', 'Explore'],
        datasets: [{
            label: '# of Votes',
            data: [Chrome, Mozila, Opera, Safari, Explore],
            backgroundColor: [
                'rgba(255, 99, 132, 2)',
                'rgb(21, 124, 228, 2)',
                'rgba(21, 228, 21, 2)',
                'rgba(228, 228, 21, 2)',
                'rgba(249, 163, 76, 2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 2)',
                'rgba(21, 124, 228, 2)',
                'rgba(21, 228, 21, 2)',
                'rgba(228, 228, 21, 2)',
                'rgba(249, 163, 76, 2)'
            ],
            borderWidth: 1
        }]
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