<?php include 'connecteoupas.php'; ?>
<?php
include 'conexionbdd.php';
$query = $db->prepare("SELECT o.id_offre_de_stage, o.nom_offre, e.nom_entreprise, v.nom_ville, s.nom_secteur_activite FROM offre_de_stage o  JOIN entreprise e ON e.id_entreprise=o.id_entreprise JOIN possede p ON p.id_entreprise = e.id_entreprise JOIN secteur_activite s ON s.id_secteur_activite=p.id_secteur_activite JOIN réside r ON r.id_entreprise = e.id_entreprise JOIN adresse a ON a.id_adresse=r.id_adresse JOIN se_localise sl ON sl.id_adresse = a.id_adresse JOIN ville v ON v.id_ville = sl.id_ville");
$query->execute();
$row = $query->fetchAll(PDO::FETCH_ASSOC);
$tableau_json = json_encode($row);
$statut = "offre";
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
  <meta name="description" content="gerer_offre_de_stage" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="style/style_gerer_offres.css" />
  <link rel="stylesheet" href="style/style_fenetre_creer_offre_stage.css" />
  <script src="API/code_postal_ville.js" defer></script>
  <script>
    var page = "<?php echo basename($_SERVER['PHP_SELF']); ?>";
  </script>

  <script src='js/js_verification_formulaire_offre_stage.js' defer></script>
  <script src='js/js_verification_formulaire_offre_stage_modification.js' defer></script>
  

  <script src="js/js_gerer.js" defer></script>


  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>



<body onload="buildTable(tableau_json, statut)">
  <?php include 'Navbar.php'; ?>
  <?php
  if (!(isset($_SESSION['statut']) && ($_SESSION['statut'] == 'admin') || $_SESSION['statut'] == 'enseignant')) {
    header('Location: pasacces.php');
  }
  ?>
  <main>

    <form action="" method="post" name="supprimerForm">
            <div id="popupsuppr">
              <div class="popupsuppr-content">
                <div id="txtpopupsuppr">
                  Voulez-vous supprimer ce pilote de manière définitive ?
                </div>
                <div>
                <input type="text" id="supid" name="supid" placeholder="id" style="display : block ;" required />
                  <button type="submit" id="Supprimer">Supprimer</button>
                  <button id="Annuler" type="button" onclick="openPopup3()">Annuler</button>
                </div>
              </div>
            </div>
        </form>
        <?php

          if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supid'])) {
            echo '<script>alert("zeazeaz");</script>';

            $supid = $_POST['supid'];
            $query = $db->prepare("DELETE FROM `max`.`necessite` WHERE (`id_offre_de_stage` = :id);");
            $query->bindValue(':id', $supid);
            $query->execute();
            $query = $db->prepare("DELETE FROM `max`.`offre_de_stage` WHERE (`id_offre_de_stage` = :id);");
            $query->bindValue(':id', $supid);
            $query->execute();
            echo '<script>alert("Offre supprimé avec succès");</script>';

            header("Location: gerer_pilotes.php");
          } ?>




    
<div class="container2">
      <div class="menu">
        <ul>
        <?php if(isset($_SESSION['statut']) && $_SESSION['statut'] == 'admin'): ?>
          <li><a href="gerer_pilotes.php">Pilotes</a></li>
          <?php endif; ?>
          <div class="square">
            <li class="active"><a href="#">Offres</a></li>
          </div>
          <li><a href="gerer_etudiants.php">Étudiants</a></li>
          <li><a href="gerer_entreprises.php">Entreprise</a></li>
        </ul>
      </div>
      <div class="squaredg">
        <div class="headertab">
          <div class="search-container">
            <input type="search" id="searchbar" onkeyup="recherche(tableau_json, statut)" placeholder="Rechercher..." />
            <img alt="search" id="imgsearch" src="image/loupe.png" />
          </div>
          <div class="btncountainer">
            <button class="btnajouter">
              <img alt="plus" class="imgplus" src="image/plus.png" />Ajouter des offres
              via un fichier CSV
            </button>
            <button onclick="openPopup1()" class="btnajouter">
              <img alt="plus" class="imgplus" src="image/plus.png" />Ajouter une offre
            </button>
          </div>
        </div>
        <div class="table-container">
          <table>
            <tr>
              <th class="bordure">#</th>
              <th class="bordure">Nom offre</th>
              <th class="bordure">Nom entreprise</th>
              <th class="bordure">ville</th>
              <th class="bordure">Secteur Activité</th>
              <th class="bordure"></th>
            </tr>

            <tbody id="myTable"></tbody>
          </table>
        </div>
      </div>
    </div>

    <div id="popupautre">
      <div onclick="openPopup2()">
        <img alt="edit" src="image/edit.png" />
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
            <label class="titre-pop-up">Modifier une offre</label>

            <form action="" id="creer_offre" method="post" name="ajout1">
              <div class="offre_page_1sur2modif">
                <div class="conteneur_page_1_creer_offre">
                  <div class="partie_gauche">

                    <div class="ligne">
                      <input id="nom_offre1modif" name="nom_offre1" placeholder="Nom de l'offre" required />
                    </div>

                    <a id="verif_nom_offremodif"></a>

                    <div class="ligne">
                      <select id="nom_entreprisemodif" name="nom_entreprise" required>
                        <option value="" disabled selected>Nom entreprise</option>
                        <?php
                        $query = $db->prepare("SELECT nom_entreprise FROM entreprise");
                        $query->execute();
                        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($row as $rows) {
                          echo '<option value="' . $rows['nom_entreprise'] . '">' . $rows['nom_entreprise'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>

                  

                    <div class="ligne">

                      <input id="nombre_placemodif" type="number" name="nombre_place" placeholder="Nombre de place" required />
                    </div>




                  </div>

                  <div class="partie_droite">

                    <div class="ligne">
                      <input id="promo_concerneesmodif" name="promo_concernees" placeholder="Promo concernées" required />
                    </div>
                    <a id="verif_promo_concerneesmodif"></a>

                    <div class="ligne">
                      <input id="remunerationmodif" name="remuneration" type="number" placeholder="Rémuneration (€)" required />
                    </div>
                    <div class="positionnement_btn_suivant_1">
                      <button class="btn_suivant_1" id="btn_suivant1modif" onclick="offre_page_vers_2sur2modif()"> Suivant</button>
                    </div>

                  </div>

                </div>



              </div>

              <div class="offre_page_2sur2modif">

                <div class="ligne_2 premiere_ligne">
                  <label for="date_debut">Date de début :</label>
                  <input id="date_debutmodif" name="date_debut" type="date" class="colonne-gauche" required />
                </div>

                <div class="ligne_2">
                  <label for="date_debut">Date de fin : </label>
                  <input id="date_finmodif" name="date_fin" type="date" class="colonne-gauche" required />

                </div>
                <div>
                  <label id="virgule_label"> Veuillez séparer les compétences avec une virgule </label>
                </div>
                <div class="ligne_2_de3">

                  <input id="competencemodif" name="competence" class="colonne-gauche" placeholder=" Compétences" required />

                  <input id="domaine_stagemodif" name="domaine_stage" class="colonne-gauche" placeholder="Secteur d'activité" />
                </div>

                <div class="ligne">
                  <textarea id="description_annoncemodif" class="description" placeholder="Description de l'annonce" required></textarea>
                </div>

                <div class="btn_prece_valid">
                  <button class="btn_precedent_1" onclick="offre_page_vers_1sur2modif()"> Précédent</button>
                  <button class="btn_valider" type="submit" id="btn_validermodif"> Valider</button>
                  <button type="button" id="btn_donnees_incorrectmodif" class="btn_valider">Merci de vérifier vos informations</button>

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
            <label class="titre-pop-up">Ajouter une offre</label>

            <form action="" id="creer_offre" method="post" name="ajout1">
              <div class="offre_page_1sur2">
                <div class="conteneur_page_1_creer_offre">
                  <div class="partie_gauche">

                    <div class="ligne">
                      <input id="nom_offre1" name="nom_offre1" placeholder="Nom de l'offre" required />
                    </div>

                    <a id="verif_nom_offre"></a>

                    <div class="ligne">
                      <select id="nom_entreprise" name="nom_entreprise" required>
                        <option value="" disabled selected>Nom entreprise</option>
                        <?php
                        $query = $db->prepare("SELECT nom_entreprise FROM entreprise");
                        $query->execute();
                        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($row as $rows) {
                          echo '<option value="' . $rows['nom_entreprise'] . '">' . $rows['nom_entreprise'] . '</option>';
                        }
                        ?>
                      </select>
                    </div>

          

                    <div class="ligne">

                      <input id="nombre_place" type="number" name="nombre_place" placeholder="Nombre de place" required />
                    </div>
                    
                  
                  
                  
                  </div>

<div class="partie_droite">



                    <div class="ligne">
                      <input id="promo_concernees" name="promo_concernees" placeholder="Promo concernées" required />
                    </div>
                    <a id="verif_promo_concernees"></a>


                    <div class="ligne">
                      <input id="remuneration" name="remuneration" type="number" placeholder="Rémuneration (€)" required />
                    </div>

                    <a id="verif_promo_concernees"></a>
                  </div>

                  <div class="partie_droite">

                    <a id="verif_nom_rue"></a>
                    <div class="positionnement_btn_suivant_1">
                      <button class="btn_suivant_1" id="btn_suivant1" onclick="offre_page_vers_2sur2()"> Suivant</button>
                    </div>

                  </div>

                </div>



              </div>

              <div class="offre_page_2sur2">

                <div class="ligne_2 premiere_ligne">
                  <label for="date_debut">Date de début :</label>
                  <input id="date_debut" name="date_debut" type="date" class="colonne-gauche" required />
                </div>

                <div class="ligne_2">
                  <label for="date_debut">Date de fin : </label>
                  <input id="date_fin" name="date_fin" type="date" class="colonne-gauche" required />

                </div>
                <div>
                  <label id="virgule_label"> Veuillez séparer les compétences avec une virgule </label>
                </div>
                <div class="ligne_2_de3">

                  <input id="competence" name="competence" class="colonne-gauche" placeholder=" Compétences" required />

                  <input id="domaine_stage" name="domaine_stage" class="colonne-gauche" placeholder="Secteur d'activité" />
                </div>

                <div class="ligne">
                  <textarea id="description_annonce" class="description" placeholder="Description de l'annonce" required></textarea>
                </div>

                <div class="btn_prece_valid">
                  <button class="btn_precedent_1" onclick="offre_page_vers_1sur2()"> Précédent</button>
                  <button class="btn_valider" type="submit" id="btn_valider"> Valider</button>
                  <button type="button" id="btn_donnees_incorrect" class="btn_valider">Merci de vérifier vos informations</button>

                </div>

              </div>


            </form>

            <div id="closecircle"></div>

            <img alt="close" id="close" src="image/close.png" onclick="openPopup1()" />





            <form>
              <div id="closecircle"></div>

              <img alt="close" id="close" src="image/close.png" onclick="openPopup1()" />

          </div>
        </div>
      </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom_offre1'])) {
      echo '<script>alert("here we go");</script>';

      $nom_offre1 = $_POST['nom_offre1'];
      $nom_entreprise = $_POST['nom_entreprise'];
      $nombre_place = $_POST['nombre_place'];
      $promo_concernees = $_POST['promo_concernees'];
      $date_debut = $_POST['date_debut'];
      $date_fin = $_POST['date_fin'];
      $competence = $_POST['competence'];
      $tabcomp = [];
      $tabcomp = explode(",", $competence);
      $domaine_stage = $_POST['domaine_stage'];
      $remuneration = $_POST['remuneration'];
      $description_annonce = $_POST['description_annonce'];
      $datepublication = date('Y-m-d H:i:s');
      // on reucpère l'id de l'entreprise
      $query = $db->prepare("SELECT id_entreprise FROM entreprise WHERE nom_entreprise=:nom_entreprise");
      $query->bindValue(':nom_entreprise', $nom_entreprise);
      $query->execute();
      $id_entreprise = $query->fetchColumn();
      // on recupere l'id
      $query = $db->prepare("INSERT INTO `max`.`offre_de_stage` (`types_de_promotion`, `remuneration`, `date_publication_offre`, `nombre_places_offertes`, `date_de_debut`, `date_de_fin`, `description_offre`, `domaine_stage`, `id_entreprise`, `nom_offre`) VALUES (:promo_concernees, :remuneration, :datepublication, :nombre_place, :date_debut, :date_fin, :description_annonce, :domaine_stage, :id_entreprise, :nom_offre1);");
      $query->bindValue(':promo_concernees', $promo_concernees);
      $query->bindValue(':remuneration', $email);
      $query->bindValue(':datepublication', $datepublication);
      $query->bindValue(':nombre_place', $nombre_place);
      $query->bindValue(':date_debut', $date_debut);
      $query->bindValue(':date_fin', $date_fin);
      $query->bindValue(':description_annonce', $description_annonce);
      $query->bindValue(':domaine_stage', $domaine_stage);
      $query->bindValue(':nom_offre1', $nom_offre1);
      $query->bindValue(':id_entreprise', $id_entreprise);
      $query->execute();
      // on recupere l'id de l'offre de stage
      $query = $db->prepare("SELECT id_offre_de_stage FROM offre_de_stage WHERE nom_offre=:nom_offre1");
      $query->bindValue(':nom_offre1', $nom_offre1);
      $query->execute();
      $id_offre_de_stage = $query->fetchColumn();

      // On insère les compétences : 
      foreach ($tabcomp as $comp) {
        // on vérifie si elle exite : 
        $query = $db->prepare("SELECT description_competence FROM competence WHERE description_competence = :competence");
        $query->bindValue(':competence', $comp);
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($row) == 0) {
          // si elle existe pas on insère
          $query = $db->prepare("INSERT INTO competence (description_competence) VALUES (:competence);");
          $query->bindValue(':competence', $comp);
          $query->execute();
        }
      }

      // on affecte les compétences à l'offres 
      $idcomp = [];
      for ($i = 0; $i < count($tabcomp); $i++) {
        $query = $db->prepare("SELECT id_competence FROM competence WHERE description_competence = :competence");
        $query->bindValue(':competence', $tabcomp[$i]);
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $idcomp = $row[0]['id_competence'];
        // on affecte chaque compétence : 
        $query_insert = $db->prepare("INSERT INTO `max`.`necessite` (`id_offre_de_stage`, `id_competence`) VALUES (:id_offre_de_stage,:idcompetence);");
        $query_insert->bindValue(':idcompetence', $idcomp);
        $query_insert->bindValue(':id_offre_de_stage', $id_offre_de_stage);
        $query_insert->execute();
        echo '<script>alert("Offre ajouté avec succès");</script>';
      }
    }
    ?>

  </main>

  <?php include 'footer.php'; ?>

</body>

</html>