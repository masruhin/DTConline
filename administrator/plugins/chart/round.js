var userGuru = document.getElementById("userguru").value;
var userSiswa = document.getElementById("usersiswa").value;

var ctx = document.getElementById('roundchart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['User Accessor', 'User Participants'],
        datasets: [{
            label: '# of Votes',
            data: [userGuru, userSiswa],
            backgroundColor: [
                'rgba(255, 99, 132, 2)',
                'rgba(54, 162, 235, 2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 2)',
                'rgba(54, 162, 235, 2)'
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