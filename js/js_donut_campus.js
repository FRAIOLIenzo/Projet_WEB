
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Campus', 'Localisation'],
          ['Nancy',     20],
          ['Strasbourg',      2],
          ['Reims',  2],
          ['Nanterre', 2],
     
        ]);

        var options = {
         
          pieHole: 0,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut_campus'));
        chart.draw(data, options);
      }
