<?php include 'connecteoupas.php'; ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Recherche de stage</title>
  <meta name="description" content="recherche de stage" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style_recherche_stage.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
$username = "max";
$password = "]$;8ytb]%n-Jg;^";
try {
    $pdo = new PDO('mysql:host=db.aws.gop.onl;dbname=max', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour obtenir l'ID maximum de l'entreprise
    $sql_max_id = "SELECT MAX(id_offre_de_stage) AS max_id FROM offre_de_stage";
    $stmt_max_id = $pdo->query($sql_max_id);
    $row_max_id = $stmt_max_id->fetch(PDO::FETCH_ASSOC);
    $max_id = $row_max_id['max_id'];

    // Utiliser l'ID maximum de l'entreprise dans la boucle
    for ($i = 1; $i <= $max_id; $i++) {
        // Requête SQL pour récupérer les détails de l'offre de stage avec l'ID actuel de la boucle
        $sql = "SELECT o.types_de_promotion, o.remuneration, o.date_publication_offre, 
        o.nombre_places_offertes, o.date_de_debut, o.date_de_fin, o.description_offre, 
        o.domaine_stage, o.id_entreprise, e.nom_entreprise, e.adresse_mail, r.etage, a.nom_rue, a.numero_rue,
        c.description_competence
        FROM offre_de_stage o
        JOIN entreprise e ON o.id_entreprise = e.id_entreprise
        JOIN réside r ON e.id_entreprise = o.id_entreprise
        JOIN adresse a ON e.id_entreprise = o.id_entreprise
        JOIN necessite n ON o.id_offre_de_stage = n.id_offre_de_stage
        JOIN competence c ON n.id_competence = c.id_competence
        WHERE o.id_offre_de_stage = $i";

        $stmt = $pdo->query($sql);

        // Récupération des données de l'offre de stage
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Vérification s'il y a des données à afficher
        if ($row) {
            $types_de_promotion = $row['types_de_promotion'];
            $remuneration = $row['remuneration'];
            $date_publication_offre = $row['date_publication_offre'];
            $nombre_places_offertes = $row['nombre_places_offertes'];
            $date_de_debut = $row['date_de_debut'];
            $date_de_fin = $row['date_de_fin'];
            $description_offre = $row['description_offre'];
            $domaine_stage = $row['domaine_stage'];
            $id_entreprise = $row['id_entreprise'];
            $nom_entreprise = $row['nom_entreprise'];
            $etage = $row['etage'];
            $nom_rue = $row['nom_rue'];
            $numero_rue = $row['numero_rue'];
            $adresse_mail = $row['adresse_mail'];
            $description_competence = $row['description_competence'];

            // Affichage des détails de l'offre de stage
?>
            <div class="offre_stage">
                <div class="box_domaine_stage">
                    <label class="text_domaine_stage"><?php echo $domaine_stage; ?></label>
                    <label class="nom_entreprise"><?php echo $nom_entreprise; ?></label>
                    <label class="lieu_stage"><?php echo $numero_rue; ?> <?php echo $nom_rue; ?></label>
                    <label class="remuneration_stage"><?php echo $remuneration; ?></label>
                    <div class="fond_wishlist">
                        <img class="img_wishlist" src="image/bookmark.png" alt="bannière de wishlist" />
                    </div>
                </div>
                <div class="trait"></div>
                <div class="description_stage">
                    <label class="text_description_stage"><?php echo $description_offre; ?></label>
                </div>
                <div class="bas_offre_stage">
                    <label class="date_publi"><?php echo $date_publication_offre; ?></label>
                </div>
                <div class="fond_plus popup_trigger" data-popup-id="<?php echo $i; ?>">
                  <img class="img_plus" src="image/plus_noir.png" alt="bouton pour voir plus d'offre de stage" />
                </div>
            </div>

            
    <div class="popup_offre_de_stage" id="popup_offre_de_stage<?php echo $i; ?>">
      <div class="content_popup_offre_stage">
        <div class="box_domaine_stage_popup">
          <div class="box_gauche_domaine_stage">
            <label class="text_domaine_stage"><?php echo $domaine_stage; ?></label>
            <label class="nom_entreprise"><?php echo $nom_entreprise; ?></label>
            <label class="lieu_stage"><?php echo $numero_rue; ?> <?php echo $nom_rue; ?></label>
            <label class="remuneration_stage"><?php echo $remuneration; ?></label>
          </div>
          <div class="trait_vertical"></div>
          <div class="box_droite_domaine_stage">
            <label class="promotion_concernee"><?php echo $types_de_promotion; ?></label>
            <label class="date_stage">Du : <?php echo $date_de_debut; ?> au <?php echo $date_de_fin; ?></label>
            <label class="nb_place">Nombre de places disponibles : <?php echo $nombre_places_offertes; ?></label>
            <label class="adresse_mail">Contact : <?php echo $adresse_mail; ?></label>
          </div>
        </div>
        <div class="trait"></div>
        <div class="box_competences">
          <ul class="competence">
            <li><?php echo $description_competence; ?></li>
            <li>-</li>
            <li><?php echo $description_competence; ?></li>
            <li>-</li>
            <li><?php echo $description_competence; ?></li>
          </ul>
        </div>
        <div class="description_stage">
          <label class="text_description_stage"><?php echo $description_offre; ?></label>
        </div>
        <div class="box_btn">
          <button class="btn_annuler" id="btn_annuler">Annuler</button>
          <button class="btn_postuler" id="btn_postuler">Postuler</button>
        </div>
      </div>
    </div>
<?php
        }
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}

// Fermeture de la connexion
$pdo = null;
?>






    <div class="popup_postuler" id="popup_postuler">
      <div class="content_popup_postuler">
        <label class="text_popup">Téléverser votre CV en format PDF</label>

        <button class="btn_cv" id="custom_btn">
    <img class="img_cv" src="image/pdf.png">
    <span class="btn_text">Sélectionner votre fichier</span>
</button>
<input type="file" id="file_input" style="display: none;">

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