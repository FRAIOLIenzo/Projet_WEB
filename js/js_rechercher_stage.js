// Récupère l'élément image d'étoile par son ID
// Sélectionne tous les éléments avec la classe "popup_trigger"
const popupTriggers = document.querySelectorAll(".popup_trigger");
const btnTrigger = document.getElementById("btn_annuler");

// Récupère l'élément de superposition et la boîte modale par leur ID
const overlay = document.getElementById("overlay");
const popup = document.getElementById("popup_offre_de_stage");

// Fonction pour afficher la boîte modale
function openPopup() {
  overlay.style.display = "block"; // Affiche la superposition
  popup.style.display = "block"; // Affiche la boîte modale
}

// Fonction pour fermer la boîte modale
function closePopup() {
  overlay.style.display = "none"; // Cache la superposition
  popup.style.display = "none"; // Cache la boîte modale
}

// Ajoute un gestionnaire d'événements pour le clic sur l'image d'étoile
// Parcourt chaque élément et ajoute un gestionnaire d'événements pour le clic
popupTriggers.forEach((trigger) => {
  trigger.addEventListener("click", openPopup);
});
btnTrigger.addEventListener("click", closePopup);

// Ferme la boîte modale lorsque l'utilisateur clique en dehors de celle-ci
window.addEventListener("click", function (event) {
  if (event.target === overlay) {
    closePopup();
  }
});