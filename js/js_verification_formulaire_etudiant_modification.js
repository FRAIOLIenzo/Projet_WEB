document.addEventListener("DOMContentLoaded", function () {
    const inpur_prenommodif = document.getElementById("prenommodif");
    const balise_prenommodif = document.querySelector("#verif_prenommodif");
  
    const input_nommodif = document.getElementById("nommodif");
    const balise_nommodif = document.querySelector("#verif_nommodif");
  
    const input_emailmodif = document.getElementById("emailmodif");
    const balise_emailmodif = document.querySelector("#verif_emailmodif");
  
    const input_motdepassemodif = document.getElementById("motdepassemodif");
    const balise_motdepassemodif = document.querySelector("#verif_motdepassemodif");
  
  
  
    document.addEventListener("click", function (event) {
      /*PRENOM*/
      const valeur_prenom = inpur_prenommodif.value.trim();
      if (
        valeur_prenom !== "" &&
        !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_prenom)
      ) {
        balise_prenommodif.style.display = "block";
        balise_prenommodif.textContent =
          "Ne doit contenir aucun chiffres ou caractères spéciaux";
      } else {
        balise_prenommodif.style.display = "none";
      }
  
      /* NOM */
  
      const valeur_nom = input_nommodif.value.trim();
      if (valeur_nom !== "" && !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom)) {
        balise_nommodif.style.display = "block";
        balise_nommodif.textContent =
          "Ne doit contenir aucun chiffres ou caractères spéciaux";
      } else {
        balise_nommodif.style.display = "none";
      }
  
      /* ADRESSE MAIL*/
  
      const valeur_email = input_emailmodif.value.trim();
      if (
        valeur_email !== "" &&
        !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valeur_email)
      ) {
        balise_emailmodif.style.display = "block";
        balise_emailmodif.textContent = "Veuillez entrer une adresse e-mail valide";
      } else {
        balise_emailmodif.style.display = "none";
      }
  
      /* MDP */
  
      const valeur_motdepasse = input_motdepassemodif.value.trim();
      if (
        valeur_motdepasse !== "" &&
        !/(?=(?:.*[0-9]){2})(?=(?:.*[^A-Za-z0-9]){2})(?=.{7,})/.test(
          valeur_motdepasse
        )
      ) {
        balise_motdepassemodif.style.display = "block";
        balise_motdepassemodif.textContent =
          "Le mot de passe doit contenir au moins 7 caractères, avec au moins 2 chiffres et caractères spéciaux.";
      } else {
        balise_motdepassemodif.style.display = "none";
      }
  
      // Afficher ou masquer les boutons en si les champs sont ok ou non 
      if (
        balise_prenommodif.style.display === "block" ||
        balise_nommodif.style.display === "block" ||
        balise_emailmodif.style.display === "block" ||
        balise_motdepassemodif.style.display === "block"
      ) {
        btn_validermodif.style.display = "none";
        btn_donnees_incorrectmodif.style.display = "block";
      } else {
        btn_validermodif.style.display = "block";
        btn_donnees_incorrectmodif.style.display = "none";
      }
    });
  });
  