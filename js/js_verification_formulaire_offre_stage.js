document.addEventListener('DOMContentLoaded', function() {
    const input_nom_offre = document.getElementById('nom_offre1');
    const balise_nom_offre = document.querySelector('#verif_nom_offre');
    
    const input_promo_concernees = document.getElementById('promo_concernees');
    const balise_promo_concernees = document.querySelector('#verif_promo_concernees');




    document.addEventListener('click', function(event) {


        /* NOM DE L OFFRE */

        const valeur_nom_offre = input_nom_offre.value.trim();
        if (valeur_nom_offre !== '' && !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_offre)) {
          balise_nom_offre.style.display = 'block'; 
          balise_nom_offre.textContent = 'Ne doit contenir aucun chiffres ou caractères spéciaux'; 
        } else {
          balise_nom_offre.style.display = 'none';
        }
        

        /* PROMO CONCERNEES */

        const valeur_nom_promo_concernees = input_promo_concernees.value.trim();
        if (valeur_nom_promo_concernees !== '' && !/^[a-zA-Z0-9\s]+$/u.test(valeur_nom_promo_concernees)) {
            balise_promo_concernees.style.display = 'block'; 
            balise_promo_concernees.textContent = 'Ne doit contenir aucun caractères spéciaux'; 
        } else {
            balise_promo_concernees.style.display = 'none';
        }
        

        
        


         // Afficher ou masquer les boutons en si les champs sont ok ou non 
    if (
        balise_nom_offre.style.display === "block" ||
        
        balise_promo_concernees.style.display === "block"

      ) {
        btn_valider.style.display = "none";
        btn_donnees_incorrect.style.display = "block";
      } else {
        btn_valider.style.display = "block";
        btn_donnees_incorrect.style.display = "none";
      }

      
    });
});
