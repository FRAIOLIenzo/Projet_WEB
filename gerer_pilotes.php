<?php include 'connecteoupas.php'; ?>
<?php
            include 'conexionbdd.php'; 

            //$query = $db->prepare("SELECT e.id_compte, c.nom, c.prenom, c.adresse_mail, p.nom_promo, ce.nom_centre FROM etudiant e JOIN compte c ON e.id_compte = c.id_compte JOIN etudie_dans ed ON ed.id_compte = e.id_compte JOIN promo p ON p.id_promo = ed.id_promo JOIN travaille_dans t ON t.id_promo = p.id_promo JOIN Centre ce ON ce.id_centre=t.id_centre");
            $query = $db->prepare("SELECT e.id_compte, c.nom, c.prenom, c.adresse_mail, p.nom_promo, ce.nom_centre FROM enseignant e JOIN compte c ON e.id_compte = c.id_compte JOIN pilote pi ON pi.id_compte = e.id_compte JOIN promo p ON p.id_promo = pi.id_promo JOIN travaille_dans t ON t.id_promo = p.id_promo JOIN Centre ce ON ce.id_centre=t.id_centre");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $tableau_json = json_encode($row);
?>
<script>
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
  <link rel="stylesheet" href="style/style_gerer_pilotes.css" />
  <script src="js/js_gerer.js" defer></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>

<body onload="buildTable(tableau_json)">
  <?php include 'Navbar.php'; ?>

  <?php
    if (!(isset($_SESSION['statut']) && $_SESSION['statut'] == 'admin')) {
      header('Location: pasacces.php');
        }
?>
  
  <main>
    <div class="container2">
      <div class="menu">
        <ul>
          <div class="square">
            <li class="active"><a href="gerer_pilotes.php">Pilotes</a></li>
          </div>
          <li><a href="gerer_offres.php">Offres</a></li>
          <li><a href="gerer_etudiants.php">Étudiants</a></li>
          <li><a href="gerer_entreprises.php">Entreprise</a></li>
        </ul>
      </div>
      <div class="squaredg">
        <div class="headertab">
          <div class="search-container">
            <input type="search" id="searchbar" onkeyup="recherche(tableau_json)" placeholder="Rechercher..." />
            <img id="imgsearch" src="image/loupe.png" />
          </div>
          <div class="btncountainer">
            <button class="btnajouter">
              <img alt="plus" class="imgplus" src="image/plus.png" />Ajouter des pilotes
              via un fichier CSV
            </button>
            <button onclick="openPopup1()" class="btnajouter">
              <img alt="plus" class="imgplus" src="image/plus.png" />Ajouter un pilote
            </button>
          </div>
        </div>
        <div class="table-container">
          <table id="tabinfo">
            <tr>
              <th class="bordure">#</th>
              <th class="bordure">Nom</th>
              <th class="bordure">Prénom</th>
              <th class="bordure">Centre</th>
              <th class="bordure">Mail</th>
              <th class="bordure">Promo</th>
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
        <div id="creertxt">Modifier le compte pilote</div>

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
      <div class="popupcontent">
        <div id="creertxt">Créer le compte pilote</div>

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

        <img alt ="close" id="close" src="image/close.png" onclick="openPopup1()" />
      </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $email = $_POST['email'];
      $motdepasse = $_POST['motdepasse'];
      $centre = $_POST['centre'];
      $promotion = $_POST['promotion'];
      $query = $db->prepare("INSERT INTO pilote (nom, prenom, email, motdepasse, centre, promotion) VALUES (:nom, :prenom, :email, :motdepasse, :centre, :promotion)");
      $query->bindValue(':nom', $nom);
      $query->bindValue(':prenom', $prenom);
      $query->bindValue(':email', $email);
      $query->bindValue(':motdepasse', $motdepasse);
      $query->bindValue( 'promotion', $promotion);
      $query->bindValue( 'centre', $centre);
      $query->execute();
      echo '<script>alert("Pilote ajouté avec succès");</script>';}
      ?>



    <div id="popupsuppr">
      <div class="popupsuppr-content">
        <div id="txtpopupsuppr">
          Voulez-vous supprimer ce pilote de manière définitive ?
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