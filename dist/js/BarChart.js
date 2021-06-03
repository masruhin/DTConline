var nilai_10 = document.getElementById("nilai_10").value;
var nilai_20 = document.getElementById("nilai_20").value;
var nilai_30 = document.getElementById("nilai_30").value;
var nilai_40 = document.getElementById("nilai_40").value;
var nilai_50 = document.getElementById("nilai_50").value;
var nilai_60 = document.getElementById("nilai_60").value;
var nilai_70 = document.getElementById("nilai_70").value;
var nilai_80 = document.getElementById("nilai_80").value;
var nilai_90 = document.getElementById("nilai_90").value;
var nilai_100 = document.getElementById("nilai_100").value;

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: ['0-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71-80', '81-90', '90-100'],
      datasets: [{
          label: '# Students',
          data: [nilai_10, nilai_20, nilai_30, nilai_40, nilai_50, nilai_60, nilai_70, nilai_80, nilai_90, nilai_100],
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(215, 215, 45, 0.2)',
              'rgba(41, 157, 99, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(227, 255, 20, 0.2)',
              'rgba(1, 228, 141, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(12, 247, 157, 0.2)'
          ],
          borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(215, 215, 45, 1)',
              'rgba(41, 157, 99, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(227, 255, 20, 1)',
              'rgba(1, 228, 141, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(12, 247, 157, 1)'
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