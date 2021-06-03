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

var ctx = document.getElementById('Linechart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  
  data: {
      labels: ['0-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', '71-80', '81-90', '90-100'],
      datasets: [{
          label: '# Students',
          data: [nilai_10, nilai_20, nilai_30, nilai_40, nilai_50, nilai_60, nilai_70, nilai_80, nilai_90, nilai_100],
          backgroundColor: [
            'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
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