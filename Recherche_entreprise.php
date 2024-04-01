<?php include 'connecteoupas.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Recherche de stage</title>
    <meta name="description" content="recherche d'entreprise" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_navbar.css" />
    <link rel="stylesheet" href="style/style_footer.css" />
    <link rel="stylesheet" href="style/style_recherche_entreprise.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>

<body>
    <?php include 'Navbar.php'; ?>
    <div class="container_recherche">
        <div class="box_recherche">
            <label class="text_box_recherche">Commencer votre recherche d'entreprise ici</label>
            <div class="input_box_recherche">
                <img class="img_loupe" src="image/loupe_recherche.png" alt="loupe de recherche" />
                <input class="input_recherche" type="text" id="text_recherche" placeholder="Tapez votre recherche ici" />
                <button class="btn_recherche">Rechercher</button>
            </div>
        </div>
    </div>

    <div class="container_aff_entreprise">

    <?php

// Fonction pour remplacer une donnée dans une balise HTML avec une classe spécifique
function remplacerDonneeParClasse($html, $classe, $nouvelleDonnee) {
    // Créer un objet DOMDocument
    $dom = new DOMDocument();
    // Charger le code HTML fourni
    $dom->loadHTML($html);
    // Créer un objet DOMXPath
    $xpath = new DOMXPath($dom);
    // Sélectionner toutes les balises avec la classe spécifiée
    $elements = $xpath->query("//*[@class='$classe']");
    // Parcourir toutes les balises trouvées
    foreach ($elements as $element) {
        // Remplacer le contenu de la balise par la nouvelle donnée
        $element->nodeValue = $nouvelleDonnee;
    }
    // Récupérer le code HTML modifié
    $nouveauHtml = $dom->saveHTML();
    // Retourner le HTML modifié
    return $nouveauHtml;
}

// Votre code HTML initial
$html = '<div class="aff_entreprise">
            <div class="box_info_entreprise">
                <div class="box_img_entreprise">
                    <img class="img_entreprise" src="image/entreprise.png" alt="menu avis" />
                </div>
                <div class="box_entreprise">
                    <label class="nom_entreprise">Nom de l\'entreprise</label>
                    <label class="localisation_entreprise">Localisation de l\'entreprise</label>
                    <div class="box_avis">
                        <label class="avis_entreprise">Avis</label>

                        <label class="nb_avis_entreprise">(Nombre d\'avis)</label>
                    </div>
                </div>
            </div>
            <div class="trait"></div>
            <div class="description_entreprise">
                <label class="text_description_entreprise">Description de l\'entreprise...</label>
            </div>
            <div class="bas_aff_entreprise">
                <label class="date_publi">Date de publication</label>
            </div>
            <div class="fond_star popup_trigger">
                <img class="img_star" src="image/star.png" alt="menu avis" />
            </div>
        </div>';

// Répéter la modification quatre fois
for ($i = 0; $i < 4; $i++) {
    $nombreAleatoire = rand(1, 1000);
    $nombreAleatoire2 = mt_rand(1, 50) / 10;

    $html = remplacerDonneeParClasse($html, 'nom_entreprise', 'Google' . $i);
    $html = remplacerDonneeParClasse($html, 'localisation_entreprise', 'Paris');
    $html = remplacerDonneeParClasse($html, 'avis_entreprise', 'Note : ' .$nombreAleatoire2 .'/5');
    $html = remplacerDonneeParClasse($html, 'nb_avis_entreprise', '(' . $nombreAleatoire . ' avis)' );
    $html = remplacerDonneeParClasse($html, 'text_description_entreprise', "Google est une super entreprise.");
    $html = remplacerDonneeParClasse($html, 'date_publi', 'Date de publication : 19/03/2024');

    echo $html;
}

?>


    </div>
    </div>

    <div class="popup_avis_entreprise" id="popup_avis_entreprise">
        <div class="content_poppup_avis_entreprise">
            <div class="box_info_personne">
                <img class="img_personne" src="image/profil.png" alt="image profil de la personne">
                <div class="nom_personne">Nom personne</div>
            </div>
            <div class="box_etoiles_avis">
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
            </div>
            <div class="box_commentaire_avis">

                <textarea class="commentaire_avis" id="commentaire_avis" name="comment" rows="8" cols="50" placeholder="Partagez votre expérience concernant cette entreprise"></textarea>

            </div>
            <div class="box_btn">
                <button class="btn_annuler" id="btn_annuler">Annuler</button>
                <button class="btn_publier">Publier</button>
            </div>
        </div>
    </div>


    <div class="overlay" id="overlay"></div>

    <?php include 'footer.php'; ?>

    <script src="js/js_rechercher_entreprise.js" defer></script>
</body>

</html>