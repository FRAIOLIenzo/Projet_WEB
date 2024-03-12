var myArray = [
  {
    numero: "1",
    nom: "Dupont",
    prenom: "Jean",
    centre: "Centre 1",
    mail: "jean.dupont@example.com",
    promo: "Promotion 2022",
    plus: "Wesh",
  },
  {
    numero: "2",
    nom: "Martin",
    prenom: "Marie",
    centre: "Centre 2",
    mail: "marie.martin@example.com",
    promo: "Promotion 2023",
    plus: "Wesh",
  },
  {
    numero: "3",
    nom: "Dubois",
    prenom: "Pierre",
    centre: "Centre 3",
    mail: "pierre.dubois@example.com",
    promo: "Promotion 2021",
    plus: "Wesh",
  },
  {
    numero: "4",
    nom: "Bernard",
    prenom: "Sophie",
    centre: "Centre 1",
    mail: "sophie.bernard@example.com",
    promo: "Promotion 2022",
    plus: "Wesh",
  },
  {
    numero: "5",
    nom: "Thomas",
    prenom: "Luc",
    centre: "Centre 2",
    mail: "luc.thomas@example.com",
    promo: "Promotion 2023",
    plus: "Wesh",
  },
  {
    numero: "6",
    nom: "Petit",
    prenom: "Alice",
    centre: "Centre 3",
    mail: "alice.petit@example.com",
    promo: "Promotion 2021",
    plus: "Wesh",
  },
  {
    numero: "5",
    nom: "Thomas",
    prenom: "Luc",
    centre: "Centre 2",
    mail: "luc.thomas@example.com",
    promo: "Promotion 2023",
    plus: "Wesh",
  },
  {
    numero: "6",
    nom: "Petit",
    prenom: "Alice",
    centre: "Centre 3",
    mail: "alice.petit@example.com",
    promo: "Promotion 2021",
    plus: "Wesh",
  },
  {
    numero: "5",
    nom: "Thomas",
    prenom: "Luc",
    centre: "Centre 2",
    mail: "luc.thomas@example.com",
    promo: "Promotion 2023",
    plus: "Wesh",
  },
  {
    numero: "6",
    nom: "Petit",
    prenom: "Alice",
    centre: "Centre 3",
    mail: "alice.petit@example.com",
    promo: "Promotion 2021",
    plus: "Wesh",
  },
  {
    numero: "5",
    nom: "Thomas",
    prenom: "Luc",
    centre: "Centre 2",
    mail: "luc.thomas@example.com",
    promo: "Promotion 2023",
    plus: "Wesh",
  },
  {
    numero: "6",
    nom: "Petit",
    prenom: "Alice",
    centre: "Centre 3",
    mail: "alice.petit@example.com",
    promo: "Promotion 2021",
    plus: "Wesh",
  },
  {
    numero: "5",
    nom: "Thomas",
    prenom: "Luc",
    centre: "Centre 2",
    mail: "luc.thomas@example.com",
    promo: "Promotion 2023",
    plus: "Wesh",
  },
  {
    numero: "6",
    nom: "Petit",
    prenom: "Alice",
    centre: "Centre 3",
    mail: "alice.petit@example.com",
    promo: "Promotion 2021",
    plus: "Wesh",
  },
  {
    numero: "5",
    nom: "Thomas",
    prenom: "Luc",
    centre: "Centre 2",
    mail: "luc.thomas@example.com",
    promo: "Promotion 2023",
    plus: "Wesh",
  },
  {
    numero: "6",
    nom: "Petit",
    prenom: "Alice",
    centre: "Centre 3",
    mail: "alice.petit@example.com",
    promo: "Promotion 2021",
    plus: "Wesh",
  },
];

buildTable(myArray);
function buildTable(data) {
  var table = document.getElementById("myTable");
  table.innerHTML = "";

  for (var i = 0; i < data.length; i++) {
    var row = `<tr>
                    <td>${data[i].numero}</td>
                    <td>${data[i].nom}</td>
                    <td>${data[i].prenom}</td>
                    <td>${data[i].centre}</td>
                    <td>${data[i].mail}</td>
                    <td>${data[i].promo}</td>
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
function openPopup1() {
  let popup = document.getElementById("popupajout1");
  popup.classList.toggle("open");
}
function openPopup2() {
  let popup = document.getElementById("popupmodifier");
  popup.classList.toggle("open");
}

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
