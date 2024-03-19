function donnees_verifiees() {
    var longueur_code = document.getElementById("code_postal").value.length;

    if (longueur_code != 5) {
        alert("Le code postal doit contenir strictement 5 chiffres !!! " + longueur_code);
        return false; // Empêche la soumission du formulaire si la validation échoue
    }
    return true; // Permet la soumission du formulaire si la validation réussit
}
