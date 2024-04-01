function buildTable(data) {
  var table = document.getElementById("myTable");
  table.innerHTML = "";

  for (var i = 0; i < data.length; i++) {
    var row = `<tr>
                    <td>${data[i].id_compte}</td>
                    <td>${data[i].nom}</td>
                    <td>${data[i].prenom}</td>
                    <td>""</td>
                    <td>${data[i].adress_mail}</td>
                    <td>${data[i].nom_promo}</td>
                    <td><img class="imgautre" src="image/autre.png"></td>
              </tr>`;
    table.innerHTML += row;
  }
  attachImageEventListeners();
}

function openPopup() {
  let popup = document.getElementById("popupautre");
  popup.style.display = "block";
  document.body.classList.remove("disable-scroll");
}
function closePopup() {
  let popup = document.getElementById("popupautre");
  popup.style.display = "none";
}

function offre_page_vers_1sur3() {
  let offrePage1sur3 = document.querySelector(".offre_page_1sur3");
  let offrePage2sur3 = document.querySelector(".offre_page_2sur3");
  let offrePage3sur3 = document.querySelector(".offre_page_3sur3");
  offrePage1sur3.style.display = "block";
  offrePage2sur3.style.display = "none";
  offrePage3sur3.style.display = "none";
}

function offre_page_vers_2sur3() {
  let offrePage1sur3 = document.querySelector(".offre_page_1sur3");
  let offrePage2sur3 = document.querySelector(".offre_page_2sur3");
  let offrePage3sur3 = document.querySelector(".offre_page_3sur3");
  offrePage1sur3.style.display = "none";
  offrePage2sur3.style.display = "block";
  offrePage3sur3.style.display = "none";
}

function offre_page_vers_3sur3() {
  let offrePage1sur3 = document.querySelector(".offre_page_1sur3");
  let offrePage2sur3 = document.querySelector(".offre_page_2sur3");
  let offrePage3sur3 = document.querySelector(".offre_page_3sur3");
  offrePage1sur3.style.display = "none";
  offrePage2sur3.style.display = "none";
  offrePage3sur3.style.display = "block";
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
      var rowData = [];
      // Parcourt chaque cellule de la ligne
      row.querySelectorAll("td").forEach(function (cell) {
        // Ajoute le contenu de la cellule au tableau de données de la ligne
        rowData.push(cell.textContent);
      });
      console.log("Données de la ligne cliquée:", rowData);
      var prenom = document.getElementById("prenom");
      var nom = document.getElementById("nom");
      var nom = document.getElementById("nom");
      var mail = document.getElementById("email");
      var mdp = document.getElementById("motdepasse");

      prenom.value = rowData[1];
      nom.value = rowData[2];
      mail.value = rowData[4];
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
