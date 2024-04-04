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


// Sélection de la liste
var liste = document.getElementById("listeEntreprises");

// Effacement du contenu actuel de la liste
liste.innerHTML = "";
var sixPremiers = donutData3.slice(0, 6);
// Boucle à travers le tableau d'entreprises et de leurs notes pour créer les éléments de liste
sixPremiers.forEach(function (entrepriseNote) {
  var entreprise = entrepriseNote[0];
  var note = entrepriseNote[1];
  var li = document.createElement("li");
  li.textContent = entreprise + " - Note : " + note;
  liste.appendChild(li);
});



  // Tableau de données


  // Sélection du corps du tableau
  var tableBody = document.getElementById("tableBody");

  // Effacement du contenu actuel du corps du tableau
  tableBody.innerHTML = "";
  var troisPremiers = donutData4.slice(0, 3);
  // Boucle à travers le tableau de données pour créer les lignes et les cellules
  troisPremiers.forEach(function(rowData) {
    var row = document.createElement("tr");

    rowData.forEach(function(cellData) {
      var cell = document.createElement("td");
      cell.textContent = cellData;
      row.appendChild(cell);
    });

    tableBody.appendChild(row);
  });