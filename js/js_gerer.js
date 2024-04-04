function buildTable(data, status) {
  var table = document.getElementById("myTable");
  table.innerHTML = "";
  if (status == "pilote" || status == "etudiant") {
    for (var i = 0; i < data.length; i++) {
      var row = `<tr>
                    <td>${data[i].id_compte}</td>
                    <td>${data[i].nom}</td>
                    <td>${data[i].prenom}</td>
                    <td>${data[i].nom_centre}</td>
                    <td>${data[i].adresse_mail}</td>
                    <td>${data[i].nom_promo}</td>
                    <td><img class="imgautre" alt="autre"  src="image/autre.png"></td>
              </tr>`;
      table.innerHTML += row;
    }
  }
  if (status == "offre") {
    for (var i = 0; i < data.length; i++) {
      var row = `<tr>
                    <td>${data[i].id_offre_de_stage}</td>
                    <td>${data[i].nom_entreprise}</td>
                    <td>${data[i].types_de_promotion}</td>
                    <td>${data[i].nom_ville}</td>
                    <td>${data[i].nom_secteur_activite}</td>
                    <td><img class="imgautre" alt="autre" src="image/autre.png"></td>
              </tr>`;
      table.innerHTML += row;
    }
  }
  if (status == "entreprise") {
    for (var i = 0; i < data.length; i++) {
      var row = `<tr>
                    <td>${data[i].id_entreprise}</td>
                    <td>${data[i].nom_entreprise}</td>
                    <td>${data[i].numero_siret}</td>
                    <td>${data[i].nom_secteur_activite}</td>
                    <td>${data[i].nom_ville}</td>
                    <td><img class="imgautre" src="image/autre.png"></td>
              </tr>`;
      table.innerHTML += row;
    }
  }

  attachImageEventListeners();
}

const bouton_suivant_1 = document.querySelector(".btn_suivant_1");
bouton_suivant_1.addEventListener("click", (event) => {
  event.preventDefault();
});

const bouton_precedent_1 = document.querySelector(".btn_precedent_1");
bouton_precedent_1.addEventListener("click", (event) => {
  event.preventDefault();
});

function openPopup() {
  let popup = document.getElementById("popupautre");
  popup.style.display = "block";
  document.body.classList.remove("disable-scroll");
}
function closePopup() {
  let popup = document.getElementById("popupautre");
  popup.style.display = "none";
}

function offre_page_vers_1sur2() {
  let offrePage1sur2 = document.querySelector(".offre_page_1sur2");
  let offrePage2sur2 = document.querySelector(".offre_page_2sur2");

  offrePage1sur2.style.display = "block";
  offrePage2sur2.style.display = "none";
}

function offre_page_vers_2sur2() {
  let offrePage1sur2 = document.querySelector(".offre_page_1sur2");
  let offrePage2sur2 = document.querySelector(".offre_page_2sur2");
  offrePage1sur2.style.display = "none";
  offrePage2sur2.style.display = "block";
}

function openPopup1() {
  let popup = document.getElementById("popupajout1");
  popup.classList.toggle("open");
}
function openPopup2() {
  let popup = document.getElementById("popupmodifier");
  popup.classList.toggle("open");
}
function openPopup3() {
  let popup = document.getElementById("popupsuppr");
  popup.classList.toggle("open");
}

function recherche(myArray) {
  document
    .querySelector("#searchbar")
    .addEventListener("keyup", function (event) {
      var value = event.target.value;
      console.log("Value : ", value);
      var data = searchTable(value, myArray);
      buildTable(data);
    });
  function searchTable(value, data) {
    var filteredData = [];

    for (var i = 0; i < data.length; i++) {
      value = value.toLowerCase();
      var prenom = data[i].prenom.toLowerCase();
      if (prenom.includes(value)) {
        filteredData.push(data[i]);
      }
    }
    return filteredData;
  }
}
function attachImageEventListeners() {
  document.querySelectorAll(".imgautre").forEach((img) => {
    img.addEventListener("click", function (event) {
      rowData = [];
      openPopup();
      var rect = img.getBoundingClientRect(); // Obtient les dimensions et la position de l'image par rapport à la fenêtre visible
      var x = rect.left + window.scrollX; // Ajoute le décalage horizontal de défilement
      var y = rect.bottom + window.scrollY; // Ajoute le décalage vertical de défilement

      console.log(x);
      console.log(y);

      // Show the popup and position it below the clicked image
      let popup = document.getElementById("popupautre");
      popup.style.display = "block";
      popup.style.top = y + "px";
      popup.style.left = x + "px";

      // on stock la valeur de la ligne pour si il appuis sur modifier
      var row = img.closest("tr");
      // Initialise un tableau pour stocker les informations de la ligne

      // Parcourt chaque cellule de la ligne
      row.querySelectorAll("td").forEach(function (cell) {
        // Ajoute le contenu de la cellule au tableau de données de la ligne
        rowData.push(cell.textContent);
      });
      console.log("Données de la ligne cliquée:", rowData);
      if (page == "gerer_etudiants.php" || page == "gerer_pilotes.php") {
        var prenom = document.getElementById("prenom");
        var nom = document.getElementById("nom");
        var nom = document.getElementById("nom");
        var mail = document.getElementById("email");
        var mdp = document.getElementById("motdepasse");
        var id = document.getElementById("idsup");
        var id2 = document.getElementById("idsup2");
        var promoc = document.getElementById("promoc");
        var centrec = document.getElementById("centrec");

        prenom.value = rowData[1];
        nom.value = rowData[2];
        mail.value = rowData[4];
        id.value = rowData[0];
        id2.value = rowData[0];
        console.log("rowData 5", rowData[5]);
        promoc.value = rowData[5];
        console.log("promoc.value", promoc.value);
        centrec.value = rowData[3];
      }
      if (page == "gerer_offres.php") {
        var supid = document.getElementById("supid");

        supid.value = rowData[0];
      }
      if (page == "gerer_entreprises.php") {
        var supid = document.getElementById("idsup3");

        supid.value = rowData[0];
      }
    });
  });
}
attachImageEventListeners();

document.addEventListener("click", function (event) {
  var popup = document.getElementById("popupautre");
  var imgautre = document.getElementsByClassName("imgautre");

  // Vérifie si l'élément cliqué est une image
  var isImageClicked = false;
  for (var i = 0; i < imgautre.length; i++) {
    if (event.target === imgautre[i]) {
      isImageClicked = true;
      break;
    }
  }

  // Si l'élément cliqué n'est pas une image, fermer le popup
  if (!isImageClicked && event.target !== popup) {
    closePopup();
  }
});

document
  .querySelector(".table-container")
  .addEventListener("scroll", function (event) {
    closePopup();
  });

const button = document.querySelector(".btn_password");
button.addEventListener("click", (event) => {
  event.preventDefault();
});
