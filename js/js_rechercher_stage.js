const popupTriggers = document.querySelectorAll(".popup_trigger");
const btnTrigger = document.querySelectorAll(".btn_annuler");

const btnTrigger2 = document.getElementById("btn_postuler");

const overlay = document.getElementById("overlay");
const popup = document.getElementById("popup_offre_de_stage");
const popup2 = document.getElementById("popup_postuler");


function openPopup() {
  overlay.style.display = "block"; // Affiche la superposition
  popup.style.display = "block"; // Affiche la boîte modale
}

function openPopup2() {
    overlay.style.display = "block"; // Affiche la superposition
    popup2.style.display = "block"; // Affiche la boîte modale
    popup.style.display = "none";
  }

function closePopup() {
  overlay.style.display = "none"; // Cache la superposition
  popup.style.display = "none"; // Cache la boîte modale
}

function closePopup2() {
    overlay.style.display = "none"; // Cache la superposition
    popup2.style.display = "none"; // Cache la boîte modale
  }


// Ajoute un gestionnaire d'événements pour le clic sur l'image d'étoile
// Parcourt chaque élément et ajoute un gestionnaire d'événements pour le clic
popupTriggers.forEach((trigger) => {
  trigger.addEventListener("click", openPopup);
});

btnTrigger.forEach((trigger) => {
    trigger.addEventListener("click", closePopup);
    trigger.addEventListener("click", closePopup2);
  });;

btnTrigger2.addEventListener("click", openPopup2);





window.addEventListener("click", function (event) {
  if (event.target === overlay) {
    closePopup();
    closePopup2();
  }
});