document.addEventListener("DOMContentLoaded", function () {
  const input_code_postal = document.getElementById("code_postal");
  const balise_code_postal = document.querySelector("#verif_code_postal");

  const input_nom_entreprise = document.getElementById("nom_entreprise");
  const balise_nom_entreprise = document.querySelector("#verif_nom_entreprise");

  const input_num_tel = document.getElementById("num_tel");
  const balise_num_tel = document.querySelector("#verif_num_tel");

  const input_adresse_mail = document.getElementById("adresse_mail");
  const balise_adresse_mail = document.querySelector("#verif_adresse_mail");

  const input_num_siret = document.getElementById("num_siret");
  const balise_num_siret = document.querySelector("#verif_num_siret");

  const input_nom_rue = document.getElementById("nom_rue");
  const balise_nom_rue = document.querySelector("#verif_nom_rue");

  document.addEventListener("click", function (event) {
    /*CODE POSTAL*/
    const valeur_code_postal = input_code_postal.value.trim();
    if (valeur_code_postal !== "" && !/^\d{5}$/.test(valeur_code_postal)) {
      balise_code_postal.style.display = "block";
      balise_code_postal.textContent =
        "Le code postal doit contenir exactement 5 chiffres";
    } else {
      balise_code_postal.style.display = "none";
    }

    /* NOM DE L ENTREPRISE*/

    const valeur_nom_entreprise = input_nom_entreprise.value.trim();
    if (
      valeur_nom_entreprise !== "" &&
      !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_entreprise)
    ) {
      balise_nom_entreprise.style.display = "block";
      balise_nom_entreprise.textContent =
        "Ne doit contenir aucun chiffres ou caractères spéciaux";
    } else {
      balise_nom_entreprise.style.display = "none";
    }

    /*NUM num_tel*/

    const valeur_num_tel = input_num_tel.value.trim();
    if (
      valeur_num_tel !== "" &&
      !/^(01|02|03|04|05|06|07)\d{8}$/.test(valeur_num_tel)
    ) {
      balise_num_tel.style.display = "block";
      balise_num_tel.textContent =
        "Le numéro de téléphone doit commencer par 01 jusqu'à 07 et contenir exactement 10 chiffres au total";
    } else {
      balise_num_tel.style.display = "none";
    }

    /* ADRESSE MAIL*/

    const valeur_adresse_mail = input_adresse_mail.value.trim();
    if (
      valeur_adresse_mail !== "" &&
      !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valeur_adresse_mail)
    ) {
      balise_adresse_mail.style.display = "block";
      balise_adresse_mail.textContent =
        "Veuillez entrer une adresse e-mail valide";
    } else {
      balise_adresse_mail.style.display = "none";
    }

    /* NUM siret */

    const valeur_num_siret = input_num_siret.value.trim();
    if (valeur_num_siret !== "" && !/^\d{14}$/.test(valeur_num_siret)) {
      balise_num_siret.style.display = "block";
      balise_num_siret.textContent =
        "Le numéro SIRET doit contenir exactement 14 chiffres";
    } else {
      balise_num_siret.style.display = "none";
    }

    /* NOM DE LA RUE */

    const valeur_nom_nom_rue = input_nom_rue.value.trim();
    if (
      valeur_nom_nom_rue !== "" &&
      !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_nom_rue)
    ) {
      balise_nom_rue.style.display = "block";
      balise_nom_rue.textContent =
        "Ne doit contenir aucun chiffres ou caractères spéciaux";
    } else {
      balise_nom_rue.style.display = "none";
    }

    if (
      balise_code_postal.style.display === "block" ||
      balise_nom_entreprise.style.display === "block" ||
      balise_num_tel.style.display === "block" ||
      balise_adresse_mail.style.display === "block"||
      balise_num_siret.style.display === "block"||
      balise_nom_rue.style.display === "block"
    ) {
      btn_valider.style.display = "none";
      btn_donnees_incorrect.style.display = "block";
    } else {
      btn_valider.style.display = "block";
      btn_donnees_incorrect.style.display = "none";
    }

    
  });
});
