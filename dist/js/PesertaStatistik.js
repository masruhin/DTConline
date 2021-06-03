var total_sudah_quiz = document.getElementById("total_sudah_quiz").value;
var total_belum_quiz = document.getElementById("total_belum_quiz").value;

var ctx = document.getElementById('PesertaStatistik').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: ['Belum Ujian', 'Sudah Ujian'],
      datasets: [{
          label: '# Students',
          data: [total_belum_quiz, total_sudah_quiz],
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)'
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