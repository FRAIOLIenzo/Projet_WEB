document.addEventListener('DOMContentLoaded', function() {
    const input_nom_offremodif = document.getElementById('nom_offre1modif');
    const balise_nom_offremodif = document.querySelector('#verif_nom_offremodif');
    
    const input_promo_concerneesmodif = document.getElementById('promo_concerneesmodif');
    const balise_promo_concerneesmodif = document.querySelector('#verif_promo_concerneesmodif');




    document.addEventListener('click', function(event) {


        /* NOM DE L OFFRE */

        const valeur_nom_offremodif = input_nom_offremodif.value.trim();
        if (valeur_nom_offremodif !== '' && !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_offremodif)) {
          balise_nom_offremodif.style.display = 'block'; 
          balise_nom_offremodif.textContent = 'Ne doit contenir aucun chiffres ou caractères spéciaux'; 
        } else {
          balise_nom_offremodif.style.display = 'none';
        }
        

        /* PROMO CONCERNEES */

        const valeur_promo_concerneesmodif = input_promo_concerneesmodif.value.trim();
        if (valeur_promo_concerneesmodif !== '' && !/^[a-zA-Z0-9\s]+$/u.test(valeur_promo_concerneesmodif)) {
            balise_promo_concerneesmodif.style.display = 'block'; 
            balise_promo_concerneesmodif.textContent = 'Ne doit contenir aucun caractères spéciaux'; 
        } else {
            balise_promo_concerneesmodif.style.display = 'none';
        }
        

        
        


         // Afficher ou masquer les boutons en si les champs sont ok ou non 
    if (
        balise_nom_offremodif.style.display === "block" ||
        
        balise_promo_concerneesmodif.style.display === "block"

      ) {
        btn_validermodif.style.display = "none";
        btn_donnees_incorrectmodif.style.display = "block";
      } else {
        btn_validermodif.style.display = "block";
        btn_donnees_incorrectmodif.style.display = "none";
      }

      
    });
});
