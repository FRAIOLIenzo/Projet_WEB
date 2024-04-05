<?php include 'connecteoupas.php'; ?>
<?php
include 'conexionbdd.php';
$query = $db->prepare("SELECT e.id_compte, c.nom, c.prenom, c.adresse_mail, pi.date_debut, p.nom_promo, ce.nom_centre FROM enseignant e LEFT JOIN compte c ON e.id_compte = c.id_compte LEFT JOIN pilote pi ON pi.id_compte = e.id_compte LEFT JOIN promo p ON p.id_promo = pi.id_promo LEFT JOIN Centre ce ON ce.id_centre=pi.id_centre");
$query->execute();
$row = $query->fetchAll(PDO::FETCH_ASSOC);
$tableau_json = json_encode($row);
$statut = "pilote";
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
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="style/style_gerer_pilotes.css" />
  <link rel="stylesheet" href="style/style_fenetre_gerer_pilotes.css" />
  <script src="js/js_gerer.js" defer></script>
  <script src="js/js_verification_formulaire_pilote.js" defer></script>
  <script src="js/js_verification_formulaire_pilote_modification.js" defer></script>



  <script>
    var page = "<?php echo basename($_SERVER['PHP_SELF']); ?>";
  </script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" />
</head>

<body onload="buildTable(tableau_json, statut)">
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
            <input type="search" id="searchbar" onkeyup="recherche(tableau_json,statut)" placeholder="Rechercher..." />
            <img id="imgsearch" src="image/loupe.png" />
          </div>
          <div class="btncountainer">
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

        <form action="" method="post" class="formcreer1">
          <input type="text" id="idsup" name="id" placeholder="id" style="display : none ;" required />
          <input type="text" id="promoc" value="a" name="promoc" style="display : none ;" required />
          <input type="text" id="centrec" name="centrec" style="display : none ;" required />
          <div id="nomprenom">
            <div id="prenom1" class="aaaa">
              <input id="prenommodif" name="prenom" placeholder="Prénom" required />
              <a id="verif_prenommodif"></a>

            </div>

            <div id="nom1">
              <input type="text" id="nommodif" name="nom" placeholder="Nom" required />

              <a id="verif_nommodif"></a>

            </div>



          </div>
          <select id="centremodif" name="centre">
            <option value="" disabled selected>Centre</option>
            <?php
            $query = $db->prepare("SELECT nom_centre FROM Centre");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($row as $rows) {
              echo '<option value="' . $rows['nom_centre'] . '">' . $rows['nom_centre'] . '</option>';
            }
            ?>
          </select>
          <select id="promotion" name="promotion">
            <option value="" disabled selected>Promotion</option>
            <?php
            $query = $db->prepare("SELECT nom_promo FROM promo");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($row as $rows) {
              echo '<option value="' . $rows['nom_promo'] . '">' . $rows['nom_promo'] . '</option>';
            }
            ?>
          </select>
          <input type="email" id="emailmodif" name="email" placeholder="Adresse e-mail" required />
          <a id="verif_emailmodif"></a>
          <input type="password" id="motdepassemodif" name="motdepasse" placeholder="Mot de passe" required />
          <a id="verif_motdepassemodif"></a>
          <input type="submit" id="btn_validermodif" value="Valider" />
          <button type="button" id="btn_donnees_incorrectmodif">Merci de vérifier vos informations</button>
        </form>
        <div id="closecircle"></div>

        <img alt="close" id="close" src="image/close.png" onclick="openPopup2()" />
      </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $email = $_POST['email'];
      $motdepasse = $_POST['motdepasse'];
      $centre = $_POST['centre'];
      $promotion = $_POST['promotion'];
      $id = $_POST['id'];
      $promoc = $_POST['promoc'];
      $centrec = $_POST['centrec'];

      try {
        // Update the account in the `compte` table
        $query = $db->prepare("UPDATE `max`.`compte` SET `adresse_mail` = :email, `nom` = :nom, `prenom` = :prenom, `mot_de_passe` = :motdepasse WHERE (`id_compte` = :id);");
        $query->bindValue(':nom', $nom);
        $query->bindValue(':prenom', $prenom);
        $query->bindValue(':email', $email);
        $query->bindValue(':motdepasse', $motdepasse);
        $query->bindValue(':id', $id);
        $query->execute();

        // Get the ID of the current promotion
        $query = $db->prepare("SELECT p.id_promo FROM max.promo p WHERE p.nom_promo=:promo;");
        // Get the ID of the new promotion
        $query->bindValue(':promo', $promotion);
        $query->execute();
        $idpromoc = $query->fetchColumn(); // Fetch single column directly
        echo '<script>alert(' . $idpromoc . ');</script>';

        // Selecte the `centre` 
        $query = $db->prepare("SELECT id_centre FROM max.Centre WHERE nom_centre=:centre;");
        $query->bindValue(':centre', $centre);
        $query->execute();
        $idcentre = $query->fetchColumn();
        echo '<script>alert("bientot2");</script>';

        // Update the `pilote` table
        $query = $db->prepare("UPDATE pilote SET id_promo = :idpromo, id_centre = :idcentre WHERE `id_compte` = :id");
        $query->bindValue(':id', $id);
        $query->bindValue(':idpromo', $idpromoc);
        $query->bindValue(':idcentre', $idcentre);


        $query->execute();

        echo '<script>alert("Modif ajouté avec succès");</script>';
      } catch (PDOException $e) {
        // Handle PDO exception
        echo "Error: " . $e->getMessage();
      }
    }
    ?>


    <div id="popupajout1">
      <div class="popupcontent">
        <div id="creertxt">Créer le compte pilote</div>

        <form action="" class="formcreer1" method="post">

          <div>
            <div id="nomprenom">
              <div id="prenom1" class="aaaa">
                <input id="prenom_inserer" name="prenom" placeholder="Prénom" required />
                <a id="verif_prenom"></a>

              </div>

              <div id="nom1">
                <input type="text" id="nom_inserer" name="nom" placeholder="Nom" required />

                <a id="verif_nom"></a>

              </div>



            </div>
          </div>





          <div>
            <select id="centre" name="centre" required>
              <option value="" disabled selected>Centre</option>

              <?php
              $query = $db->prepare("SELECT nom_centre FROM Centre");
              $query->execute();
              $row = $query->fetchAll(PDO::FETCH_ASSOC);
              foreach ($row as $rows) {
                echo '<option value="' . $rows['nom_centre'] . '">' . $rows['nom_centre'] . '</option>';
              }
              ?>
            </select>
            <select id="promotion" name="promotion" required>
              <option value="" disabled selected>Promotion</option>
              <?php
              $query = $db->prepare("SELECT nom_promo FROM promo");
              $query->execute();
              $row = $query->fetchAll(PDO::FETCH_ASSOC);
              foreach ($row as $rows) {
                echo '<option value="' . $rows['nom_promo'] . '">' . $rows['nom_promo'] . '</option>';
              }
              ?>


            </select>
          </div>
          <input type="email" id="email_inserer" name="email1" placeholder="Adresse e-mail" required />
          <a id="verif_email"></a>
          <input type="password" id="motdepasse_inserer" name="motdepasse" placeholder="Mot de passe" required />
          <a id="verif_motdepasse"></a>


          <input type="submit" id="btn_valider" value="Valider" />
          <button type="button" id="btn_donnees_incorrect">Merci de vérifier vos informations</button>
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
      // on recupere l'id
      $query = $db->prepare("SELECT id_centre FROM Centre WHERE nom_centre=:centre;");
      $query->bindValue(':centre', $centre);
      $query->execute();
      $row = $query->fetchAll(PDO::FETCH_ASSOC);
      $idcentre = $row[0]['id_centre'];
      // on recupere id de la promo 
      $query = $db->prepare("SELECT p.id_promo FROM max.promo p WHERE p.nom_promo=:promo;");
      $query->bindValue(':promo', $promotion);
      $query->execute();
      $row2 = $query->fetchAll(PDO::FETCH_ASSOC);
      $idpromo = $row2[0]['id_promo'];

      // On insere l'enseignant dans la base de donnée
      $query = $db->prepare("INSERT INTO `max`.`enseignant` (`id_compte`) VALUES (:id);");
      $query->bindValue(':id', $id);
      $query->execute();
      $query = $db->prepare("INSERT INTO `max`.`pilote` (`id_compte`, `id_promo`, `id_centre`) VALUES (:id, :idpromo, :idcentre);");
      $query->bindValue(':id', $id);
      $query->bindValue(':idpromo', $idpromo);
      $query->bindValue(':idcentre', $idcentre);

      $query->execute();
      header("Location: " . $_SERVER['PHP_SELF']);
      echo '<script>alert("Pilote ajouté avec succès");</script>';
    }
    ?>


    <form action="" method="post" name="supprimerForm">
      <div id="popupsuppr">
        <div class="popupsuppr-content">
          <div id="txtpopupsuppr">
            Voulez-vous supprimer ce pilote de manière définitive ?
          </div>
          <div>
            <input type="text" id="idsup2" name="id2" placeholder="id" style="display : block ;" required />
            <button type="submit" id="Supprimer">Supprimer</button>
            <button id="Annuler" type="button" onclick="openPopup3()">Annuler</button>
          </div>
        </div>
      </div>
      </div>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id2'])) {
      $id2 = $_POST['id2'];
      $query = $db->prepare("DELETE FROM `max`.`pilote` WHERE id_compte = :id;");
      $query->bindValue(':id', $id2);
      $query->execute();
      $query = $db->prepare("DELETE FROM `max`.`enseignant` WHERE id_compte = :id;");
      $query->bindValue(':id', $id2);
      $query->execute();
      $query = $db->prepare("DELETE FROM `max`.`compte` WHERE id_compte = :id;");
      $query->bindValue(':id', $id2);
      $query->execute();
      echo '<script>alert("Pilote ajouté avec succès");</script>';
      header("Location: gerer_pilotes.php");
    } ?>
  </main>


  <?php include 'footer.php'; ?>

</body>

</html>