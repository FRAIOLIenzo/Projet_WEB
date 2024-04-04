<?php include 'connecteoupas.php'; ?>
<?php
include 'conexionbdd.php';
$query = $db->prepare("SELECT e.id_entreprise, e.nom_entreprise,e.numero_siret ,s.nom_secteur_activite, v.nom_ville FROM entreprise e LEFT JOIN possede p ON p.id_entreprise = e.id_entreprise LEFT JOIN secteur_activite s ON s.id_secteur_activite=p.id_secteur_activite LEFT JOIN réside r ON r.id_entreprise = e.id_entreprise LEFT JOIN adresse a ON a.id_adresse=r.id_adresse LEFT JOIN se_localise sl ON sl.id_adresse = a.id_adresse LEFT JOIN ville v ON v.id_ville = sl.id_ville	");
$query->execute();
$row = $query->fetchAll(PDO::FETCH_ASSOC);
$tableau_json = json_encode($row);
$statut = "entreprise";
?>
<script>
  var statut = "<?php echo $statut; ?>";
  var tableau_json = <?php echo $tableau_json; ?>;
</script>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>noStage</title>
  <meta name="description" content="gerer_entreprise" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style/style_navbar.css" />

  <link rel="stylesheet" href="style/style_gerer_entreprises.css" />
  <script src="js/js_gerer.js" defer></script>
  <script>
    var page = "<?php echo basename($_SERVER['PHP_SELF']); ?>";
    </script>

  <link rel="stylesheet" href="style/style_fenetre_creer_entreprise.css" />
  <script src="API/code_postal_ville.js" defer></script>
  <script src='js/js_verification_formulaire_entreprise.js' defer></script>
  <script src='js/js_verification_formulaire_entreprise_modification.js' defer></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>

<body onload="buildTable(tableau_json, statut)">
  <?php include 'Navbar.php'; ?>
  <?php
  if (!(isset($_SESSION['statut']) && ($_SESSION['statut'] == 'admin') || $_SESSION['statut'] == 'pilote')) {
    header('Location: pasacces.php');
  }
  ?>


  <main>
  <form action="" method="post">
      <div id="popupsuppr">
        <div class="popupsuppr-content">
          <div id="txtpopupsuppr">
            Voulez-vous supprimer ce pilote de manière définitive ?
          </div>
          <div>
            <input type="text" id="idsup3" name="idsup3" placeholder="id" style="display : block ;" required />
            <button type="submit" id="Supprimer">Supprimer</button>
            <button id="Annuler" type="button" onclick="openPopup3()">Annuler</button>
          </div>
        </div>
      </div>
    </div>
</form>


<?php
  if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['idsup3']))) {
    
    $id2 = $_POST['idsup3'];
    echo '<script>alert("'.$id2.'");</script>';

    $query = $db->prepare("DELETE FROM `max`.`réside` WHERE id_entreprise = :id;");
    $query->bindValue(':id', $id2);
    $query->execute();
    $query = $db->prepare("DELETE FROM `max`.`possede` WHERE id_entreprise = :id;");
    $query->bindValue(':id', $id2);
    $query->execute();
    // on verifie si ya avis : 
    $query = $db->prepare("SELECT id_entreprise FROM Avis WHERE id_entreprise=:id;");
    $query->bindValue(':id', $id2);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
      // Vérifie si la ville existe déjà
    if ($row) {
        $query = $db->prepare("DELETE FROM `max`.`avis` WHERE id_entreprise = :id;");
        $query->bindValue(':id', $id2);
        $query->execute();
    }
    $query = $db->prepare("DELETE FROM `max`.`entreprise` WHERE id_entreprise = :id;");
    $query->bindValue(':id', $id2);
    $query->execute();
    echo '<script>alert("Pilote ajouté avec succès");</script>';
    header("Location: gerer_pilotes.php");
  } ?>







    <div class="container2">
      <div class="menu">
        <ul>
          <li><a href="gerer_pilotes.php">Pilotes</a></li>
          <li><a href="gerer_offres.php">Offres</a></li>
          <li><a href="gerer_etudiants.php">Étudiants</a></li>
          <div class="square">
            <li><a class="active" href="gerer_entreprises.php">Entreprise</a></li>
          </div>
        </ul>
      </div>
      <div class="squaredg">
        <div class="headertab">
          <div class="search-container">
            <input type="search" id="searchbar" onkeyup="recherche(tableau_json)" placeholder="Rechercher..." />
            <img alt="loupe" id="imgsearch" src="image/loupe.png" />
          </div>
          <div class="btncountainer">
            <button class="btnajouter">
              <img alt="plus" class="imgplus" src="image/plus.png" />Ajouter des
              entreprises via un fichier CSV
            </button>
            <button onclick="openPopup1()" class="btnajouter">
              <img alt="plus" class="imgplus" src="image/plus.png" />Ajouter une entreprise
            </button>
          </div>
        </div>
        <div class="table-container">
          <table>
            <tr>
              <th class="bordure">#</th>
              <th class="bordure">Nom</th>
              <th class="bordure">Numéro de Siret</th>
              <th class="bordure">Secteur d'activitée</th>
              <th class="bordure">Ville</th>
              <th class="bordure"></th>
            </tr>

            <tbody id="myTable"></tbody>
          </table>
        </div>
      </div>
    </div>

    <div id="popupautre">
      <div onclick="openPopup2()">
        <img alt="edti" src="image/edit.png" />
        Modifier
      </div>
      <div onclick="openPopup3()">
        <img alt="delete" src="image/delete.png" />
        Supprimer
      </div>
    </div>

    <div id="popupmodifier">
      <div class="box">
        <div class="box_connexion">
          <div class="box_connexion_contenu">
            <label class="titre-pop-up" >Modifier une entreprise</label>
            <form action="" id="creer_entreprise" class="formcreer_entreprise" method="post">
              <div class="offre_page_1sur2modif">
                <div class="conteneur_page_1_creer_offre">
                  <div class="partie_gauche">

                    <div class="ligne">
                      <input id="nom_entreprisemodif" name="nom_entreprise" placeholder="Nom de l'entreprise" required />
                    </div>

                    <a id="verif_nom_entreprisemodif"></a>

                    <div class="ligne">
                      <input id="num_telmodif" type="number" name="num_tel" placeholder="Numéro de téléphone" required />
                    </div>

                    <a id="verif_num_telmodif"></a>

                    <div class="ligne">

                      <input id="adresse_mailmodif" name="adresse_mail" type="email" placeholder="Adresse mail" required/>
                    </div>

                    <a id="verif_adresse_mailmodif"></a>

                    <div class="ligne">

                      <input id="num_siretmodif" name="num_siret" type="number" class="colonne-gauche" placeholder="Numérot de siret" required />
                    </div>

                    <a id="verif_num_siretmodif"></a>


                  </div>

                  <div class="trait"></div>
                  <div class="partie_droite">

                    <div class="ligne">
                      <input id="code_postalmodif" type="number" name="code_postal" placeholder="Code postal" required />
                    </div>
                    <a id="verif_code_postalmodif"></a>



                    <div class="ligne">

                      <select id="villemodif" name="ville" placeholder="Ville" required> </select>
                    </div>

                    <div class="ligne">

                      <input id="num_ruemodif" name="num_rue" type="number" placeholder="Numéro rue" required />


                    </div>

                    <div class="ligne">
                      <input id="nom_ruemodif" name="nom_rue" placeholder="Nom rue" required/>

                    </div>

                    <a id="verif_nom_ruemodif"></a>
                    <div class="positionnement_btn_suivant_1">
                      <button class="btn_suivant_1" onclick="offre_page_vers_2sur2modif()"> Suivant</button>
                    </div>

                  </div>

                </div>



              </div>

              <div class="offre_page_2sur2modif">



                <div>
                  <label id="virgule_labelmodif"> Veuillez séparer les secteurs d'activités avec une virgule </label>
                </div>

                <div class="ligne">

                  <textarea id="secteur_activitemodif" name="secteur_activite" class="description" placeholder="Secteurs d'activités" required></textarea>

                </div>



                <div class="ligne">
                  <textarea id="description_entreprisemodif" name="description_entreprise" class="description" placeholder="Description de l'entreprise" required></textarea>
                </div>

                <div class="btn_prece_valid">
                  <button class="btn_precedent_1" onclick="offre_page_vers_1sur2modif()"> Précédent</button>
                  <button class="btn_valider" type="submit" id="btn_validermodif"> Valider</button>
                  <button type = "button" id="btn_donnees_incorrectmodif" class="btn_valider" >Merci de vérifier vos informations</button>

                </div>

              </div>


            </form>

            <div id="closecircle"></div>

            <img alt="close" id="close" src="image/close.png" onclick="openPopup2()" />




          

          </div>
        </div>
      </div>
    </div>

    <div id="popupajout1">
      <div class="box">
        <div class="box_connexion">
          <div class="box_connexion_contenu">
            <label class="titre-pop-up">Ajouter une entreprise</label>
            <form action="" id="creer_entreprise" class="formcreer_entreprise" method="post">
              <div class="offre_page_1sur2">
                <div class="conteneur_page_1_creer_offre">
                  <div class="partie_gauche">

                    <div class="ligne">
                      <input id="nom_entreprise" name="nom_entreprise" placeholder="Nom de l'entreprise" required />
                    </div>

                    <a id="verif_nom_entreprise"></a>

                    <div class="ligne">
                      <input id="num_tel" type="number" name="num_tel" placeholder="Numéro de téléphone" required />
                    </div>

                    <a id="verif_num_tel"></a>

                    <div class="ligne">

                      <input id="adresse_mail" name="adresse_mail" type="email" placeholder="Adresse mail" required/>
                    </div>

                    <a id="verif_adresse_mail"></a>

                    <div class="ligne">

                      <input id="num_siret" name="num_siret" type="number" class="colonne-gauche" placeholder="Numérot de siret" required />
                    </div>

                    <a id="verif_num_siret"></a>


                  </div>

                  <div class="trait"></div>
                  <div class="partie_droite">

                    <div class="ligne">
                      <input id="code_postal" type="number" name="code_postal" placeholder="Code postal" required />
                    </div>
                    <a id="verif_code_postal"></a>



                    <div class="ligne">

                      <select id="ville" name="ville" placeholder="Ville" required> </select>
                    </div>

                    <div class="ligne">

                      <input id="num_rue" name="num_rue" type="number" placeholder="Numéro rue" required />


                    </div>

                    <div class="ligne">
                      <input id="nom_rue" name="nom_rue" placeholder="Nom rue" required/>

                    </div>

                    <a id="verif_nom_rue"></a>
                    <div class="positionnement_btn_suivant_1">
                      <button class="btn_suivant_1" onclick="offre_page_vers_2sur2()"> Suivant</button>
                    </div>

                  </div>

                </div>



              </div>

              <div class="offre_page_2sur2">



                <div>
                  <label id="virgule_label"> Veuillez séparer les secteurs d'activités avec une virgule </label>
                </div>

                <div class="ligne">

                  <textarea id="secteur_activite" name="secteur_activite" class="description" placeholder="Secteurs d'activités" required></textarea>

                </div>



                <div class="ligne">
                  <textarea id="description_entreprise" name="description_entreprise" class="description" placeholder="Description de l'entreprise" required></textarea>
                </div>

                <div class="btn_prece_valid">
                  <button class="btn_precedent_1" onclick="offre_page_vers_1sur2()"> Précédent</button>
                  <button class="btn_valider" type="submit" id="btn_valider"> Valider</button>
                  <button type = "button" id="btn_donnees_incorrect" class="btn_valider" >Merci de vérifier vos informations</button>

                </div>

              </div>


            </form>

            <div id="closecircle"></div>

            <img alt="close" id="close" src="image/close.png" onclick="openPopup1()" />





          </div>
        </div>
      </div>
    </div>
    
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["num_siret"])) {
      $nom_entreprise = $_POST['nom_entreprise'];
      $num_tel = $_POST['num_tel'];
      $adresse_mail = $_POST['adresse_mail'];
      $description_entreprise = $_POST['description_entreprise'];
      $num_siret = $_POST['num_siret'];
      $secteurs_activite = $_POST['secteur_activite'];
      $numero_rue = $_POST['num_rue'];
      $nom_rue = $_POST['nom_rue'];
      $ville = $_POST['ville'];
      $code_postal = $_POST['code_postal'];
      echo '<script>alert("'.$ville.$nom_rue.$numero_rue.'");</script>';

      // Insérer l'entreprise
      $query = $db->prepare("INSERT INTO entreprise (nom_entreprise, numero_telephone, adresse_mail, description_entreprise, numero_siret) 
       VALUES (:nom_entreprise, :num_tel, :adresse_mail, :description_entreprise, :num_siret);");
      $query->bindValue(':nom_entreprise', $nom_entreprise);
      $query->bindValue(':num_tel', $num_tel);
      $query->bindValue(':adresse_mail', $adresse_mail);
      $query->bindValue(':description_entreprise', $description_entreprise);
      $query->bindValue(':num_siret', $num_siret);
      $query->execute();
      // Récupérer l'id de l'entreprise insérée
      $id_entreprise =$db->lastInsertId();
      echo '<script>alert("entreprise");</script>';

      

      // On regarde si la ville existe déjà
      $query = $db->prepare("SELECT id_ville FROM ville WHERE nom_ville=:ville;");
      $query->bindValue(':ville', $ville);
      $query->execute();
      $row = $query->fetch(PDO::FETCH_ASSOC);

      // Vérifie si la ville existe déjà
      if ($row) {
          $idville = $row['id_ville'];
      } else {
          // Si la ville n'existe pas, l'insérer
          $query = $db->prepare("INSERT INTO ville (nom_ville) VALUES (:ville);");
          $query->bindValue(':ville', $ville);
          $query->execute();
          // Récupérer l'id de la ville nouvellement insérée
          $idville = $db->lastInsertId();
      }
      echo '<script>alert("ville '.$idville.'");</script>';

      // Associer l'adresse à la ville
      $query = $db->prepare("INSERT INTO adresse (numero_rue, nom_rue) VALUES (:numero_rue, :nom_rue)");
      $query->bindValue(':numero_rue', $numero_rue);
      $query->bindValue(':nom_rue', $nom_rue);
      $query->execute();
      // on selectionne l'id de l'addresse
      $id_adresse= $db->lastInsertId();
      echo '<script>alert("'.$id_adresse." | ".$idville. '");</script>';


      // on la lie à localise 
      $query = $db->prepare("INSERT INTO se_localise (id_ville, id_adresse) VALUES (:id_ville, :id_adresse);");
      $query->bindValue(':id_ville', $idville);
      $query->bindValue(':id_adresse', $id_adresse);
      $query->execute();
      echo '<script>alert("localise");</script>';

      // puis à réside 
      $query = $db->prepare("INSERT INTO réside (id_entreprise, id_adresse) VALUES (:id_entreprise, :id_adresse);");
      $query->bindValue(':id_entreprise', $id_entreprise);
      $query->bindValue(':id_adresse', $id_adresse);
      $query->execute();
      echo '<script>alert("reside");</script>';

      // Insérer le secteur d'activité
      $query = $db->prepare("INSERT INTO secteur_activite (nom_secteur_activite) VALUES (:secteur_activite);");
      $query->bindValue(':secteur_activite', $secteurs_activite);
      $query->execute();
      // Récupérer l'id secteur d'activité
      $id_secteur_activite =$db->lastInsertId();
      echo '<script>alert("secteur");</script>';

      // Insérer les secteurs d'activité de l'entreprise
      $query = $db->prepare("INSERT INTO possede (id_entreprise, id_secteur_activite) VALUES (:id_entreprise, :id_secteur_activite);");
      $query->bindValue(':id_entreprise', $id_entreprise);
      $query->bindValue(':id_secteur_activite', $id_secteur_activite);
      $query->execute();
      echo '<script>alert("Entreprise ajouté avec siccès");</script>';

    }


    ?>


</body>

</html>