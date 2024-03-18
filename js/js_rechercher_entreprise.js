// Récupère l'élément image d'étoile par son ID
// Sélectionne tous les éléments avec la classe "popup_trigger"
const popupTriggers = document.querySelectorAll(".popup_trigger");



const btnTrigger = document.getElementById("btn_annuler");

// Récupère l'élément de superposition et la boîte modale par leur ID
const overlay = document.getElementById("overlay");
const popup = document.getElementById("popup_avis_entreprise");

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




// Récupère toutes les images avec la classe "etoiles_avis"
const etoilesImages = document.querySelectorAll(".etoiles_avis");

// Parcourt chaque image et ajoute un gestionnaire d'événements pour le clic
etoilesImages.forEach((image, index) => {
  let imageModifiee = false; // Variable pour suivre si l'image a été modifiée

  image.addEventListener("click", function () {
    if (imageModifiee) {
      // Parcourt toutes les étoiles et change le chemin de l'image vers l'image d'origine
      etoilesImages.forEach((etoile) => {
        etoile.src = "image/etoile_avis_vide.png";
      });
      imageModifiee = false; // Définit la variable à false car les étoiles sont maintenant d'origine
    } else {
      // Parcourt toutes les étoiles précédentes jusqu'à celle sur laquelle vous avez cliqué
      for (let i = 0; i <= index; i++) {
        // Change le chemin de l'image vers l'image modifiée
        etoilesImages[i].src = "image/etoile_avis.png";
      }
      imageModifiee = true; // Définit la variable à true car les étoiles sont maintenant modifiées
    }
  });
});
