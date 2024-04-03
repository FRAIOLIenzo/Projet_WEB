<?php include 'connecteoupas.php'; ?>
<?php
            include 'conexionbdd.php'; 

            $query = $db->prepare("SELECT e.id_compte, c.nom, c.prenom, c.adresse_mail, p.nom_promo, ce.nom_centre FROM etudiant e LEFT JOIN compte c ON e.id_compte = c.id_compte LEFT JOIN etudie_dans ed ON ed.id_compte = e.id_compte LEFT JOIN promo p ON p.id_promo = ed.id_promo LEFT JOIN travaille_dans t ON t.id_promo = p.id_promo LEFT JOIN Centre ce ON ce.id_centre=t.id_centre");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $tableau_json = json_encode($row);
            $statut = "etudiant";
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
    <link rel="stylesheet" href="style/style_gerer_etudiants.css" />
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
            <div class="square">
              <li><a class="active" href="gerer_etudiants.php">Étudiants</a></li>
            </div>

            <li><a href="gerer_entreprises.php">Entreprise</a></li>
          </ul>
        </div>
        <div class="squaredg">
          <div class="headertab">
            <div class="search-container">
            <input type="search" id="searchbar" onkeyup="recherche(tableau_json)" placeholder="Rechercher..." />
              <img alt="search" id="imgsearch" src="image/loupe.png" />
            </div>
            <div class="btncountainer">
              <button class="btnajouter">
                <img alt="plus" class="imgplus" src="image/plus.png" />Ajouter des
                étudiants via un fichier CSV
              </button>
              <button onclick="openPopup1()" class="btnajouter">
                <img alt="plus" class="imgplus" src="image/plus.png" />Ajouter un étudiant
              </button>
            </div>
          </div>
          <div class="table-container">
            <table>
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
          <img alt="edit" src="image/edit.png" />
          Modifier
        </div>
        <div onclick="openPopup3()">
          <img alt="delete" src="image/delete.png" />
          Supprimer
        </div>
      </div>

      <div id="popupmodifier">
        <div class="popupcontent">
          <div id="creertxt">Modifier le compte étudiant</div>

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
          <div id="creertxt">Créer le compte étudiant</div>

          <form
            action=""
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
              <?php 
            $query = $db->prepare("SELECT nom_centre FROM Centre");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($row as $rows){
              echo '<option value="'.$rows['nom_centre'].'">'.$rows['nom_centre'].'</option>';
            }
            ?>
            </select>
            <select id="promotion" name="promotion">
              <option value="" disabled selected>Promotion</option>
              <?php 
            $query = $db->prepare("SELECT nom_promo FROM promo");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($row as $rows){
              echo '<option value="'.$rows['nom_promo'].'">'.$rows['nom_promo'].'</option>';
            }
            ?>
            </select>
            <input
              type="email"
              id="email"
              name="email1"
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
      <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email1'])) {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $email = $_POST['email1'];
      $motdepasse = $_POST['motdepasse'];
      $centre = $_POST['centre'];
      $promotion = $_POST['promotion'];
      // on insere le compte pilote dans la base de donnée
      $query = $db->prepare("INSERT INTO `max`.`compte` (`adresse_mail`, `nom`, `prenom`, `mot_de_passe`) VALUES (:email, :nom,:prenom, :motdepasse)");
      $query->bindValue(':nom', $nom);
      $query->bindValue(':prenom', $prenom);
      $query->bindValue(':email', $email);
      $query->bindValue(':motdepasse', $motdepasse);
      $query->execute();
      // on recupere l'id
      $query = $db->prepare("SELECT id_compte FROM max.compte WHERE adresse_mail=:email;");
      $query->bindValue(':email', $email);
      $query->execute();
      $row = $query->fetchAll(PDO::FETCH_ASSOC);
      $id = $row[0]['id_compte'];
      // on recupere id de la promo 
      $query = $db->prepare("SELECT p.id_promo FROM max.promo p JOIN travaille_dans t ON t.id_promo = p.id_promo JOIN  Centre c on c.id_centre = t.id_centre WHERE c.nom_centre = :centre AND p.nom_promo=:promo;");
      $query->bindValue(':promo', $promotion);
      $query->bindValue(':centre', $centre);
      $query->execute();
      $row2 = $query->fetchAll(PDO::FETCH_ASSOC);
      $idpromo = $row2[0]['id_promo'];
      // On insere l'etudiant  dans la etudiant
      $query = $db->prepare("INSERT INTO etudiant (id_compte) VALUES (:id);      ");
      $query->bindValue(':id', $id);
      $query->execute();

      // On insere l'etudiant  dans la base de donnée
      $query = $db->prepare("INSERT INTO etudie_dans (id_compte, id_promo) VALUES (:id, :idpromo);      ");
      $query->bindValue(':id', $id);
      $query->bindValue(':idpromo', $idpromo);
      $query->execute();
      echo '<script>alert("Etudiant ajouté avec succès");</script>';
    }
      ?>
<form action="" method="post">
    <div id="popupsuppr">
      <div class="popupsuppr-content">
        <div id="txtpopupsuppr">
          Voulez-vous supprimer ce pilote de manière définitive ?
        </div>
        <div>
        <input type="text" id="idsup3" name="id3" placeholder="id" style="display : block ;" required />
          <button type="submit" id="Supprimer">Supprimer</button>
          <button id="Annuler" type="button" onclick="openPopup3()">Annuler</button>
        </div>
      </div>
    </div>
</form>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id3'])) {
    $id3 = $_POST['id3'];
    $query = $db->prepare("DELETE FROM etudie-dans WHERE id_compte = :id;");
    $query->bindValue(':id', $id3);
    $query->execute();
    $query = $db->prepare("DELETE FROM etudiant WHERE id_compte = :id;");
    $query->bindValue(':id', $id3);
    $query->execute();
    $query = $db->prepare("DELETE FROM compte WHERE id_compte = :id;");
    $query->bindValue(':id', $id3);
    $query->execute();
  } ?>
  </main>
    <?php include 'footer.php'; ?>

  </body>
</html>
