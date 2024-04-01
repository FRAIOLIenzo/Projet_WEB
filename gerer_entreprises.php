<?php include 'connecteoupas.php'; ?>
<?php
            include 'conexionbdd.php'; 
            $query = $db->prepare("SELECT o.id_offre_de_stage, o.types_de_promotion, e.nom_entreprise, v.nom_ville, s.nom_secteur_activite FROM offre_de_stage o  JOIN entreprise e ON e.id_entreprise=o.id_entreprise JOIN possede p ON p.id_entreprise = e.id_entreprise JOIN secteur_activite s ON s.id_secteur_activite=p.id_secteur_activite JOIN réside r ON r.id_entreprise = e.id_entreprise JOIN adresse a ON a.id_adresse=r.id_adresse JOIN se_localise sl ON sl.id_adresse = a.id_adresse JOIN ville v ON v.id_ville = sl.id_ville");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $tableau_json = json_encode($row);
            $statut = "entreprise";
?>
<script>
    var statut = "<?php echo $statut; ?>"; 
    var tableau_json = <?php echo $tableau_json;?>;
</script>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>noStage</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style/style_navbar.css" />
    <link rel="stylesheet" href="style/style_gerer_entreprises.css" />
    <script src="js/js_gerer.js" defer></script>

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    />
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
              <img alt = "loupe" id="imgsearch" src="image/loupe.png" />
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
                <th class="bordure">entreprise</th>
                <th class="bordure">Secteur d'activitée</th>
                <th class="bordure">Ville</th>
                <th class="bordure">Mail</th>
                <th class="bordure">entreprise</th>
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

          <form
            action="/votre-page-de-traitement"
            method="post"
            class="formcreer1"
          >
            <div id="nomprenom">
              <input
                type="text"
                id="prenom"
                name="prenom"
                placeholder="Prénom"
                required
              />
              <input
                type="text"
                id="nom"
                name="nom"
                placeholder="Nom"
                required
              />
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
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Adresse e-mail"
              required
            />
            <input
              type="password"
              id="motdepasse"
              name="motdepasse"
              placeholder="Mot de passe"
              required
            />
            <input type="submit" value="Valider" />
          </form>
          <div id="closecircle"></div>

          <img alt="close" id="close" src="image/close.png" onclick="openPopup2()" />
        </div>
      </div>

      <div id="popupajout1">
        <div class="popupcontent">
          <div id="creertxt">Créer le profil d'entreprise</div>

          <form
            action="/votre-page-de-traitement"
            method="post"
            class="formcreer1"
          >
            <div id="nomprenom">
              <input
                type="text"
                id="prenom"
                name="prenom"
                placeholder="Prénom"
                required
              />
              <input
                type="text"
                id="nom"
                name="nom"
                placeholder="Nom"
                required
              />
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
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Adresse e-mail"
              required
            />
            <input
              type="password"
              id="motdepasse"
              name="motdepasse"
              placeholder="Mot de passe"
              required
            />
            <input type="submit" value="Valider" />
          </form>
          <div id="closecircle"></div>

          <img alt="close" id="close" src="image/close.png" onclick="openPopup1()" />
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
