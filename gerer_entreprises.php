<?php include 'connecteoupas.php'; ?>
<?php
include 'conexionbdd.php';
$query = $db->prepare("SELECT e.id_entreprise, e.nom_entreprise,e.numero_siret ,s.nom_secteur_activite, v.nom_ville FROM entreprise e JOIN possede p ON p.id_entreprise = e.id_entreprise JOIN secteur_activite s ON s.id_secteur_activite=p.id_secteur_activite JOIN réside r ON r.id_entreprise = e.id_entreprise JOIN adresse a ON a.id_adresse=r.id_adresse JOIN se_localise sl ON sl.id_adresse = a.id_adresse JOIN ville v ON v.id_ville = sl.id_ville	");
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



  <link rel="stylesheet" href="style/style_fenetre_creer_entreprise.css" />
  <script src="API/code_postal_ville.js" defer></script>
  <script src='js/js_verification_formulaire_entreprise.js' defer></script>

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
      <div class="popupcontent">
        <div id="creertxt">Modifier le profil de l'entreprise</div>

        <form action="/votre-page-de-traitement" method="post" class="formcreer1">
          <div id="nomprenom">
            <input type="text" id="prenom" name="prenom" placeholder="Prénom" required />
            <input type="text" id="nom" name="nom" placeholder="Nom" required />
          </div>
          <select id="centre" name="centre">
            <option value="" disabled selected>Centre</option>

            <option value="centre1">Centre 1</option>
            <option value="centre2">Centre 2</option>
            <option value="centre3">Centre 3</option>
          </select>
          <select id="promotion" name="promotion">
            <option value="" disabled selected>Promotion</option>
            <option value="promotion1">Promotion 1</option>
            <option value="promotion2">Promotion 2</option>
            <option value="promotion3">Promotion 3</option>
          </select>
          <input type="email" id="email" name="email" placeholder="Adresse e-mail" required />
          <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required />
          <input type="submit" value="Valider" />
        </form>
        <div id="closecircle"></div>

        <img alt="close" id="close" src="image/close.png" onclick="openPopup2()" />
      </div>
    </div>

    <div id="popupajout1">
      <div class="box">
        <div class="box_connexion">
          <div class="box_connexion_contenu">
            <label class="titre-pop-up">Ajouter une entreprise</label>
            <form id="creer_offre">
              <div class="offre_page_1sur2">
                <div class="conteneur_page_1_creer_offre">
                  <div class="partie_gauche">

                    <div class="ligne">
                      <input id="nom_entreprise" placeholder="Nom de l'entreprise" />
                    </div>

                    <a id="verif_nom_entreprise"></a>

                    <div class="ligne">
                      <input id="num_tel" type="number" placeholder="Numéro de téléphone" />
                    </div>

                    <a id="verif_num_tel"></a>

                    <div class="ligne">

                      <input id="adresse_mail" type="email" placeholder="Adresse mail" />
                    </div>

                    <a id="verif_adresse_mail"></a>

                    <div class="ligne">

                      <input id="num_siret" type = "number" class="colonne-gauche" placeholder="Numérot de siret" />
                    </div>

                    <a id="verif_num_siret"></a>


                  </div>

                  <div class="trait"></div>
                  <div class="partie_droite">

                    <div class="ligne">
                      <input id="code_postal" type = "number" name="code_postal" placeholder="Code postal" />
                    </div>
                    <a id="verif_code_postal"></a>



                    <div class="ligne">

                      <select id="ville" placeholder="Ville"> </select>
                    </div>

                    <div class="ligne">

                      <input id="num_rue" type="number" placeholder="Numéro rue" />


                    </div>

                    <div class="ligne">
                      <input id="nom_rue" placeholder="Nom rue" />

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

                  <textarea id="secteur_activite" class="description" placeholder="Secteurs d'activités"></textarea>

                </div>



                <div class="ligne">
                  <textarea id="description_entreprise" class="description" placeholder="Description de l'entreprise"></textarea>
                </div>

                <div class="btn_prece_valid">
                  <button class="btn_precedent_1" onclick="offre_page_vers_1sur2()"> Précédent</button>
                  <button class="btn_valider" type="submit"> Valider</button>
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

    <div id="popupsuppr">
      <div class="popupsuppr-content">
        <div id="txtpopupsuppr">
          Voulez-vous supprimer cette entreprise de manière définitive ?
        </div>
        <div>
          <button id="Supprimer">Supprimer</button>
          <button id="Annuler" onclick="openPopup3()">Annuler</button>
        </div>
      </div>
    </div>
  </main>
  <?php include 'footer.php'; ?>

</body>

</html>