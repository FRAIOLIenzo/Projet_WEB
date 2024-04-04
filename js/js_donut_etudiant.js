google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
  // Créer un tableau vide pour stocker les données
  var dataCampus = [["Campus", "Localisation"]];
  var dataSecteur = [["Secteur", "Activite"]];

  // Parcourir les données JSON stockées dans la variable donutData2 pour le premier graphique
  // et ajouter chaque paire de données au tableau
  for (var i = 0; i < donutData2.length; i++) {
    dataCampus.push([donutData2[i][0], donutData2[i][1]]);
  }

  // Parcourir les données JSON stockées dans la variable donutData pour le deuxième graphique
  // et ajouter chaque paire de données au tableau
  for (var i = 0; i < donutData.length; i++) {
    dataSecteur.push([donutData[i][0], donutData[i][1]]);
  }

  var options = {
    pieHole: 0,
  };

  var chartCampus = new google.visualization.PieChart(
    document.getElementById("donut_campus")
  );
  chartCampus.draw(google.visualization.arrayToDataTable(dataCampus), options);

  var chartSecteur = new google.visualization.PieChart(
    document.getElementById("donut_secteur_activite")
  );
  chartSecteur.draw(
    google.visualization.arrayToDataTable(dataSecteur),
    options
  );
}
