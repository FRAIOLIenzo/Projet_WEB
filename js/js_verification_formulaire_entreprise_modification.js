document.addEventListener("DOMContentLoaded", function () {
  const input_code_postalmodif = document.getElementById("code_postalmodif");
  const balise_code_postalmodif = document.querySelector("#verif_code_postalmodif");

  const input_nom_entreprisemodif = document.getElementById("nom_entreprisemodif");
  const balise_nom_entreprisemodif = document.querySelector("#verif_nom_entreprisemodif");

  const input_num_telmodif = document.getElementById("num_telmodif");
  const balise_num_telmodif = document.querySelector("#verif_num_telmodif");

  const input_adresse_mailmodif = document.getElementById("adresse_mailmodif");
  const balise_adresse_mailmodif = document.querySelector("#verif_adresse_mailmodif");

  const input_num_siretmodif = document.getElementById("num_siretmodif");
  const balise_num_siretmodif = document.querySelector("#verif_num_siretmodif");

  const input_nom_ruemodif = document.getElementById("nom_ruemodif");
  const balise_nom_ruemodif = document.querySelector("#verif_nom_ruemodif");

  document.addEventListener("click", function (event) {
    /*CODE POSTAL*/
    const valeur_code_postalmodif = input_code_postalmodif.value.trim();
    if (valeur_code_postalmodif !== "" && !/^\d{5}$/.test(valeur_code_postalmodif)) {
      balise_code_postalmodif.style.display = "block";
      balise_code_postalmodif.textContent =
        "Le code postal doit contenir exactement 5 chiffres";
    } else {
      balise_code_postalmodif.style.display = "none";
    }

    /* NOM DE L ENTREPRISE*/

    const valeur_nom_entreprisemodif = input_nom_entreprisemodif.value.trim();
    if (
      valeur_nom_entreprisemodif !== "" &&
      !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_entreprisemodif)
    ) {
      balise_nom_entreprisemodif.style.display = "block";
      balise_nom_entreprisemodif.textContent =
        "Ne doit contenir aucun chiffres ou caractères spéciaux";
    } else {
      balise_nom_entreprisemodif.style.display = "none";
    }

    /*NUM num_telmodif*/

    const valeur_num_telmodif = input_num_telmodif.value.trim();
    if (
      valeur_num_telmodif !== "" &&
      !/^(01|02|03|04|05|06|07)\d{8}$/.test(valeur_num_telmodif)
    ) {
      balise_num_telmodif.style.display = "block";
      balise_num_telmodif.textContent =
        "Le numéro de téléphone doit commencer par 01 jusqu'à 07 et contenir exactement 10 chiffres au total";
    } else {
      balise_num_telmodif.style.display = "none";
    }

    /* ADRESSE MAIL*/

    const valeur_adresse_mailmodif = input_adresse_mailmodif.value.trim();
    if (
      valeur_adresse_mailmodif !== "" &&
      !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valeur_adresse_mailmodif)
    ) {
      balise_adresse_mailmodif.style.display = "block";
      balise_adresse_mailmodif.textContent =
        "Veuillez entrer une adresse e-mail valide";
    } else {
      balise_adresse_mailmodif.style.display = "none";
    }

    /* NUM siret */

    const valeur_num_siretmodif = input_num_siretmodif.value.trim();
    if (valeur_num_siretmodif !== "" && !/^\d{14}$/.test(valeur_num_siretmodif)) {
      balise_num_siretmodif.style.display = "block";
      balise_num_siretmodif.textContent =
        "Le numéro SIRET doit contenir exactement 14 chiffres";
    } else {
      balise_num_siretmodif.style.display = "none";
    }

    /* NOM DE LA RUE */

    const valeur_nom_nom_ruemodif = input_nom_ruemodif.value.trim();
    if (
      valeur_nom_nom_ruemodif !== "" &&
      !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_nom_ruemodif)
    ) {
      balise_nom_ruemodif.style.display = "block";
      balise_nom_ruemodif.textContent =
        "Ne doit contenir aucun chiffres ou caractères spéciaux";
    } else {
      balise_nom_ruemodif.style.display = "none";
    }

    if (
      balise_code_postalmodif.style.display === "block" ||
      balise_nom_entreprisemodif.style.display === "block" ||
      balise_num_telmodif.style.display === "block" ||
      balise_adresse_mailmodif.style.display === "block"||
      balise_num_siretmodif.style.display === "block"||
      balise_nom_ruemodif.style.display === "block"
    ) {
      btn_validermodif.style.display = "none";
      btn_donnees_incorrectmodif.style.display = "block";
    } else {
      btn_validermodif.style.display = "block";
      btn_donnees_incorrectmodif.style.display = "none";
    }

    
  });
});
