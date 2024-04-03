document.addEventListener('DOMContentLoaded', function() {
    const input_nom_offre = document.getElementById('nom_offre');
    const balise_nom_offre = document.querySelector('#verif_nom_offre');
    
    const input_nom_entreprise = document.getElementById('nom_entreprise');
    const balise_nom_entreprise = document.querySelector('#verif_nom_entreprise');

    const input_promo_concernees = document.getElementById('promo_concernees');
    const balise_promo_concernees = document.querySelector('#verif_promo_concernees');

    const input_nom_rue = document.getElementById('nom_rue');
    const balise_nom_rue = document.querySelector('#verif_nom_rue');

    const input_code_postal = document.getElementById('code_postal');
    const balise_code_postal = document.querySelector('#verif_code_postal');



    document.addEventListener('click', function(event) {


        /* NOM DE L OFFRE */

        const valeur_nom_offre = input_nom_offre.value.trim();
        if (valeur_nom_offre !== '' && !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_offre)) {
          balise_nom_offre.style.display = 'block'; 
          balise_nom_offre.textContent = 'Ne doit contenir aucun chiffres ou caractères spéciaux'; 
        } else {
          balise_nom_offre.style.display = 'none';
        }
        
        /*NOM DE L ENTREPRISE */

        const valeur_nom_entreprise = input_nom_entreprise.value.trim();
        if (valeur_nom_entreprise !== '' && !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_entreprise)) {
            balise_nom_entreprise.style.display = 'block'; 
            balise_nom_entreprise.textContent = 'Ne doit contenir aucun chiffres ou caractères spéciaux'; 
        } else {
            balise_nom_entreprise.style.display = 'none';
        }

        /* PROMO CONCERNEES */

        const valeur_nom_promo_concernees = input_promo_concernees.value.trim();
        if (valeur_nom_promo_concernees !== '' && !/^[a-zA-Z0-9\s]+$/u.test(valeur_nom_promo_concernees)) {
            balise_promo_concernees.style.display = 'block'; 
            balise_promo_concernees.textContent = 'Ne doit contenir aucun caractères spéciaux'; 
        } else {
            balise_promo_concernees.style.display = 'none';
        }
        

        /* NOM DE LA RUE */ 

        const valeur_nom_nom_rue = input_nom_rue.value.trim();
        if (valeur_nom_nom_rue!== '' && !/^[a-zA-ZÀ-ÖØ-öø-ÿ' ]+$/u.test(valeur_nom_nom_rue)) {
            balise_nom_rue.style.display = 'block'; 
            balise_nom_rue.textContent = 'Ne doit contenir aucun chiffres ou caractères spéciaux'; 
        } else {
            balise_nom_rue.style.display = 'none';
        }

        /*CODE POSTAL */

        const valeur_code_postal = input_code_postal.value.trim();
        if (valeur_code_postal !== '' && !/^\d{5}$/.test(valeur_code_postal)) {
            balise_code_postal.style.display = 'block';
            balise_code_postal.textContent = 'Le code postal doit contenir exactement 5 chiffres';
        } else {
            balise_code_postal.style.display = 'none';
        }
        




      
    });
});
