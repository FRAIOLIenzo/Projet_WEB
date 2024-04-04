<?php include 'connecteoupas.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Recherche de stage</title>
    <meta name="description" content="recherche d'entreprise" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_recherche_entreprise.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

 

<!-- ---------------------------------------------------------------------------------------------------- -->

<?php
$username = "max";
$password = "]$;8ytb]%n-Jg;^";
try {
    $pdo = new PDO('mysql:host=db.aws.gop.onl;dbname=max', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour obtenir l'ID maximum de l'entreprise
    $sql_max_id = "SELECT MAX(id_entreprise) AS max_id FROM entreprise";
    $stmt_max_id = $pdo->query($sql_max_id);
    $row_max_id = $stmt_max_id->fetch(PDO::FETCH_ASSOC);
    $max_id = $row_max_id['max_id'];


    
    // Utiliser l'ID maximum de l'entreprise dans la boucle
    for ($i = 1; $i <= $max_id; $i++) {
        // Requête SQL pour récupérer les détails de l'offre de stage avec l'ID actuel de la boucle
        $sql = "SELECT e.nom_entreprise, e.description_entreprise, a.numero_rue, a.nom_rue, 
        av.note_globale, av.commentaire
        FROM entreprise e
        JOIN réside r ON e.id_entreprise = r.id_entreprise
        JOIN adresse a ON r.id_adresse = a.id_adresse
        LEFT JOIN Avis av ON e.id_entreprise = av.id_entreprise
        WHERE e.id_entreprise = $i";

        $stmt = $pdo->query($sql);

        // Récupération des données de l'offre de stage
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Vérification s'il y a des données à afficher
        if ($row) {
            $nom_entreprise = $row['nom_entreprise'];
            $etage = $row['etage'];
            $nom_rue = $row['nom_rue'];
            $numero_rue = $row['numero_rue'];
            $adresse_mail = $row['adresse_mail'];
            $description_entreprise = $row['description_entreprise'];
            $note_globale = $row['note_globale'];
            $commentaire = $row['commentaire'];

            // Affichage des détails de l'offre de stage
?>
                  <div class="aff_entreprise">
            <div class="box_info_entreprise">
                <div class="box_img_entreprise">
                    <img class="img_entreprise" src="image/entreprise.png" alt="menu avis" />
                </div>
                <div class="box_entreprise">
                    <label class="nom_entreprise"><?php echo $nom_entreprise; ?></label>
                    <label class="localisation_entreprise"><?php echo $numero_rue; ?> <?php echo $nom_rue; ?></label>
                    <div class="box_avis">
                        <label class="avis_entreprise"><?php echo $note_globale; ?></label>

                        <label class="nb_avis_entreprise"><?php echo $description_competence; ?></label>
                    </div>
                </div>
            </div>
            <div class="trait"></div>
            <div class="description_entreprise">
                <label class="text_description_entreprise"><?php echo $description_entreprise; ?></label>
            </div>
            <div class="bas_aff_entreprise">
            </div>
            <div class="fond_star popup_trigger" data-popup-id="<?php echo $i; ?>">
                <img class="img_star" src="image/star.png" alt="menu avis" />
            </div>
        </div>

            
    <div class="popup_avis_entreprise" id="popup_avis_entreprise<?php echo $i; ?>">
        <div class="content_poppup_avis_entreprise">
            <div class="box_info_personne">
                <img class="img_personne" src="image/profil.png" alt="image profil de la personne">
                <div class="nom_personne"><?php echo $name;?>  <?php echo $lastname; ?></div>
            </div>
            <div class="box_etoiles_avis">
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
                <img class="etoiles_avis" src="image/etoile_avis_vide.png" alt="étoiles avis" />
            </div>
            <div class="box_commentaire_avis">

                <textarea class="commentaire_avis" name="comment" rows="8" cols="50" placeholder="Partagez votre expérience concernant cette entreprise"></textarea>

            </div>
            <div class="box_btn">
                <button class="btn_annuler">Annuler</button>
                <button class="btn_publier">Publier</button>
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





<!-- --------------------------------------------------------------------------------------------------------------- -->




</div> 

    <div class="overlay" id="overlay"></div>

    <?php include 'footer.php'; ?>

    <script src="js/js_rechercher_entreprise.js" defer></script>
</body>

</html>