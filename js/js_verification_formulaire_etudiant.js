document.addEventListener("DOMContentLoaded", function () {
    const input_prenom = document.getElementById("prenom_inserer");
    const balise_prenom = document.querySelector("#verif_prenom");
  
    const input_nom = document.getElementById("nom_inserer");
    const balise_nom = document.querySelector("#verif_nom");
  
    const input_email = document.getElementById("email_inserer");
    const balise_email = document.querySelector("#verif_email");
  
    const input_motdepasse = document.getElementById("motdepasse_inserer");
    const balise_motdepasse = document.querySelector("#verif_motdepasse");
  
    document.addEventListener("click", function (event) {
      /*PRENOM*/
      const valeur_prenom = input_prenom.value.trim();
      if (
        valeur_prenom !== "" &&
        !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_prenom)
      ) {
        balise_prenom.style.display = "block";
        balise_prenom.textContent =
          "Ne doit contenir aucun chiffres ou caractères spéciaux";
      } else {
        balise_prenom.style.display = "none";
      }
  
      /* NOM */
  
      const valeur_nom = input_nom.value.trim();
      if (valeur_nom !== "" && !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom)) {
        balise_nom.style.display = "block";
        balise_nom.textContent =
          "Ne doit contenir aucun chiffres ou caractères spéciaux";
      } else {
        balise_nom.style.display = "none";
      }
  
      /* ADRESSE MAIL*/
  
      const valeur_email = input_email.value.trim();
      if (
        valeur_email !== "" &&
        !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valeur_email)
      ) {
        balise_email.style.display = "block";
        balise_email.textContent = "Veuillez entrer une adresse e-mail valide";
      } else {
        balise_email.style.display = "none";
      }
  
      /* MDP */
  
      const valeur_motdepasse = input_motdepasse.value.trim();
      if (
        valeur_motdepasse !== "" &&
        !/(?=(?:.*[0-9]){2})(?=(?:.*[^A-Za-z0-9]){2})(?=.{7,})/.test(
          valeur_motdepasse
        )
      ) {
        balise_motdepasse.style.display = "block";
        balise_motdepasse.textContent =
          "Le mot de passe doit contenir au moins 7 caractères, avec au moins 2 chiffres et caractères spéciaux.";
      } else {
        balise_motdepasse.style.display = "none";
      }


          // Afficher ou masquer les boutons en si les champs sont ok ou non 
    if (
      balise_prenom.style.display === "block" ||
      balise_nom.style.display === "block" ||
      balise_email.style.display === "block" ||
      balise_motdepasse.style.display === "block"
    ) {
      btn_valider.style.display = "none";
      btn_donnees_incorrect.style.display = "block";
    } else {
      btn_valider.style.display = "block";
      btn_donnees_incorrect.style.display = "none";
    }
    });
  });
  