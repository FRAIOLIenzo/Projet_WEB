<?php include 'connecteoupas.php'; ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Recherche de stage</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style_navbar.css" />
  <link rel="stylesheet" href="style/style_footer.css" />
  <link rel="stylesheet" href="style/style_recherche_stage.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>

<body>
  <?php include 'Navbar.php'; ?>
  <div class="container_recherche">
    <div class="box_recherche">
      <label class="text_box_recherche">Commencer votre recherche d'offre de stage ici</label>
      <div class="input_box_recherche">
        <img class="img_loupe" src="image/loupe_recherche.png" alt="loupe de recherche" />
        <input class="input_recherche" type="text" id="text_recherche" placeholder="Tapez votre recherche ici" />
        <button class="btn_recherche">Rechercher</button>
      </div>
    </div>
  </div>

  <div class="container_offre_stage">

    <?php

    // Fonction pour remplacer une donnée dans une balise HTML avec une classe spécifique
    function remplacerDonneeParClasse($html, $classe, $nouvelleDonnee)
    {
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
    $html = '    <div class="offre_stage">
<div class="box_domaine_stage">
  <label class="text_domaine_stage">Domaine du stage</label>
  <label class="nom_entreprise">Nom de l\'entreprise</label>
  <label class="lieu_stage">Lieu du stage</label>
  <label class="remuneration_stage">Rémunération</label>
  <div class="fond_wishlist">
    <img class="img_wishlist" src="image/wishlist.png" alt="banniére de wishlist" />
  </div>
</div>
<div class="trait"></div>
<div class="description_stage">
  <label class="text_description_stage">Description du stage...</label>
</div>
<div class="bas_offre_stage">
  <label class="date_publi">Date de publication</label>

</div>
<div class="fond_plus popup_trigger">
  <img class="img_plus" src="image/plus_noir.png" alt="bouton pour voir plus d\'offre de stage" />
</div>
</div>';


    // Répéter la modification quatre fois
    for ($i = 0; $i < 100; $i++) {
      $nombreAleatoire = rand(500, 1500);
      $nombreAleatoire2 = mt_rand(1, 50) / 10;

      $html = remplacerDonneeParClasse($html, 'text_domaine_stage', 'Web designer' . $i);
      $html = remplacerDonneeParClasse($html, 'nom_entreprise', 'Google');
      $html = remplacerDonneeParClasse($html, 'lieu_stage', 'Paris');
      $html = remplacerDonneeParClasse($html, 'remuneration_stage', "" .$nombreAleatoire . " €");
      $html = remplacerDonneeParClasse($html, 'text_description_stage', "Google Cherche de super stagiaire");
      $html = remplacerDonneeParClasse($html, 'date_publi', 'Date de publication : 19/03/2024');

      echo $html;
    }

    ?>



  </div>


  <div class="popup_offre_de_stage" id="popup_offre_de_stage">
    <div class="content_popup_offre_stage">
      <div class="box_domaine_stage_popup">
        <div class="box_gauche_domaine_stage">
          <label class="text_domaine_stage">Domaine du stage</label>
          <label class="nom_entreprise">Nom de l'entreprise</label>
          <label class="lieu_stage">Lieu du stage</label>
          <label class="remuneration_stage">Rémunération</label>
        </div>
        <div class="trait_vertical"></div>
        <div class="box_droite_domaine_stage">
          <label class="promotion_concernee">Promotion concernée</label>
          <label class="date_stage">Date du stage</label>
          <label class="nb_place">nombre de place</label>
          <label class="adresse_mail">Adresse mail</label>
        </div>
      </div>
      <div class="trait"></div>
      <div class="box_competences">
        <ul class="competence">
          <li>Compétence1</li>
          <li>-</li>
          <li>Compétence2</li>
          <li>-</li>
          <li>Compétence3</li>
        </ul>
      </div>
      <div class="description_stage">
        <label class="text_description_stage">Description du stage...</label>
      </div>
      <div class="box_btn">
        <button class="btn_annuler" id="btn_annuler">Annuler</button>
        <button class="btn_postuler" id="btn_postuler">Postuler</button>
      </div>
    </div>
  </div>


  <div class="popup_postuler" id="popup_postuler">
    <div class="content_popup_postuler">
      <label class="text_popup">Téléverser votre CV en format PDF</label>
      <button class="btn_cv">
        <img class="img_cv" src="image/pdf.png">
        <span class="btn_text">Selectionner votre fichier</span>
      </button>
      <div class="trait"></div>
      <label class="text_popup">Lettre de motivation</label>
      <div class="box_lettre_motiv">
        <textarea class="lettre_motiv" id="lettre_motiv" name="comment" rows="8" cols="50" placeholder="Lettre de motivation"></textarea>
      </div>
      <div class="box_btn">
        <button class="btn_annuler" id="btn_annuler">Annuler</button>
        <button class="btn_envoyer" id="btn_envoyer">Envoyer</button>
      </div>
    </div>
  </div>


  <div class="overlay" id="overlay"></div>

  <?php include 'footer.php'; ?>

  <script src="js/js_rechercher_stage.js" async defer></script>
</body>

</html>