
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Secteur', 'Activite'],
    ['Informatiqe',     20],
    ['BTP',      25],
    ['Industrie',  12],
    ['IA', 50],

  ]);

  var options = {
   
    pieHole: 0,
  };

  var chart = new google.visualization.PieChart(document.getElementById('donut_secteur_activite'));
  chart.draw(data, options);
}
