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
                    <td> <img class="imgautre" src="image/autre.png"></td>


              </tr>`;
    table.innerHTML += row;
  }
}

function openPopup1() {
  let popup = document.getElementById("popupajout1");
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
